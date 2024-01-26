<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Собираем данные из формы
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Проверка корректности email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Некорректный запрос
        echo "Некорректный адрес электронной почты";
        exit;
    }

    // Содержимое письма
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Телефон: $phone\n\n";
    $email_content .= "Сообщение:\n$message\n";

    // Заголовки письма
    // $headers = "From: $name <$email>\r\n";
    // $headers .= "Reply-To: $email\r\n";
    // $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
    $headers .= "From: kolesnickov.marat@yandex.ru\r\n"; // Используйте действительный email-адрес
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Return-Path: your_email@example.com\r\n"; // Используйте тот же email-адрес

    // Отправка письма
    $to = 'kolesnickov.marat@yandex.ru'; // Укажите ваш email
    $subject = 'Новое сообщение с вашего сайта';

    if (mail($to, $subject, $email_content, $headers)) {
        http_response_code(200);
        echo "Сообщение успешно отправлено.";
    } else {
        http_response_code(500); // Ошибка сервера
        echo "Ошибка при отправке сообщения.";
    }
}
?>