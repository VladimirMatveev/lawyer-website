<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Подключение PHPMailer через Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Сбор данных из формы
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Проверка корректности email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Ошибка валидации email
        echo "Некорректный адрес электронной почты";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Настройки сервера
        $mail->isSMTP(); // Использовать SMTP
        $mail->Host = 'smtp.legalgroup.by'; // Адрес SMTP сервера
        $mail->SMTPAuth = true;
        $mail->Username = 'legalgroup'; // SMTP username
        $mail->Password = 'A$XGna3e)Qf3E)g3'; // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;

        // Отправитель
        $mail->setFrom('from@example.com', 'Mailer');

        // Получатель
        $mail->addAddress('kolesnickov.marat@yandex.ru', 'Marat Kolesnikov');

        // Тема и тело письма
        $mail->Subject = 'Новое сообщение с вашего сайта';
        $mail->Body    = "Имя: $name\nEmail: $email\nТелефон: $phone\n\nСообщение:\n$message";

        // Отправка
        $mail->send();
        echo 'Сообщение было успешно отправлено';
    } catch (Exception $e) {
        echo "Сообщение не было отправлено. Ошибка PHPMailer: {$mail->ErrorInfo}";
    }
}
?>




// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Собираем данные из формы
//     $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
//     $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
//     $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
//     $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

//     // Проверка корректности email
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//         // Ошибка валидации email
//         exit;
//     }

//     // Содержимое письма
//     $email_content = "Имя: $name\n";
//     $email_content .= "Email: $email\n";
//     $email_content .= "Телефон: $phone\n\n";
//     $email_content .= "Сообщение:\n$message\n";

//     // Заголовки письма
//     $headers = "From: $name <$email>";

//     // Отправка письма
//     $to = 'kolesnickov.marat@yandex.ru'; // Укажите ваш email
//     $subject = 'Новое сообщение с вашего сайта';

//     if (mail($to, $subject, $email_content, $headers)) {
//         // Письмо успешно отправлено
//         http_response_code(200);
//         echo "Сообщение успешно отправлено.";
//     } else {
//         // Не удалось отправить письмо
//         http_response_code(500); 
//         echo "Ошибка при отправке сообщения.";
//     }
// }