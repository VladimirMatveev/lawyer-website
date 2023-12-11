<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Собираем данные из формы
    $name = htmlspecialchars(strip_tags(trim($_POST['name'])));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(strip_tags(trim($_POST['phone'])));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'])));

    // Проверка корректности email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Ошибка валидации email
        exit;
    }

    // Содержимое письма
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Телефон: $phone\n\n";
    $email_content .= "Сообщение:\n$message\n";

    // Заголовки письма
    $headers = "From: $name <$email>";

    // Отправка письма
    $to = 'kolesnickov.marat@yandex.ru'; // Укажите ваш email
    $subject = 'Новое сообщение с вашего сайта';

    if (mail($to, $subject, $email_content, $headers)) {
        // Письмо успешно отправлено
        echo "Сообщение успешно отправлено.";
    } else {
        // Не удалось отправить письмо
        echo "Ошибка при отправке сообщения.";
    }
}
?>