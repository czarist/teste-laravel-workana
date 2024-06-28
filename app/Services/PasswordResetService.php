<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\PasswordResetRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class PasswordResetService
{
    protected $passwordResetRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    public function sendResetLinkEmail(string $email)
    {
        $validator = Validator::make(['email' => $email], [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error.', 'errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $token = Str::random(60);

        $this->passwordResetRepository->updateOrInsert($email, Hash::make($token));

        // Enviar o e-mail com o link de redefinição de senha
        try {
            $this->sendResetEmail($email, $token);
            return response()->json(['message' => 'Password reset link sent.'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to send email.', 'error' => $e->getMessage()], 500);
        }
    }

    protected function sendResetEmail($email, $token)
    {
        $mail = new PHPMailer(true);

        try {
            Log::info('Attempting to send reset email', ['email' => $email, 'token' => $token]);

            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION') ?: PHPMailer::ENCRYPTION_STARTTLS; // Default to TLS if null
            $mail->Port = env('MAIL_PORT');

            // Certificado SSL
            $mail->SMTPOptions = [
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ];

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Password Notification';
            $mail->Body = "Click here to reset your password: <a href='" . url('/password/reset/' . $token . '?email=' . $email) . "'>Reset Password</a>";

            if ($mail->send()) {
                Log::info('Reset email sent successfully', ['email' => $email]);
            } else {
                Log::error('Failed to send reset email', ['email' => $email, 'error' => $mail->ErrorInfo]);
                throw new Exception($mail->ErrorInfo);
            }
        } catch (Exception $e) {
            Log::error('Exception occurred while sending reset email', ['email' => $email, 'error' => $e->getMessage()]);
            throw new Exception("Mailer Error: {$e->getMessage()}");
        }
    }

    public function resetPassword(array $data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return [
                'status' => 422,
                'message' => 'Validation error.',
                'errors' => $validator->errors(),
            ];
        }

        $passwordReset = $this->passwordResetRepository->findByEmail($data['email']);

        if (!$passwordReset || !Hash::check($data['token'], $passwordReset->token)) {
            return [
                'status' => 400,
                'message' => 'Invalid token.',
            ];
        }

        $user = User::where('email', $data['email'])->first();

        if (!$user) {
            return [
                'status' => 404,
                'message' => 'User not found.',
            ];
        }

        $user->password = Hash::make($data['password']);
        $user->save();

        $this->passwordResetRepository->deleteByEmail($data['email']);

        return [
            'status' => 200,
            'message' => 'Password reseted.',
        ];
    }

}
