<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);

    // Проверка заполнения полей формы
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Здесь можно добавить код для обработки ошибки
        exit;
    }

    // Настройка отправки сообщения
    $recipient = "vlmatveev5@gmail.com"; // Замените на ваш адрес электронной почты
    $subject = "Новое сообщение с вашего сайта от $name";
    $email_content = "Имя: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Телефон: $phone\n\n";
    $email_content .= "Сообщение:\n$message\n";

    $email_headers = "From: $name <$email>";

    // Отправка письма
    mail($recipient, $subject, $email_content, $email_headers);

    // Перенаправление обратно на форму с сообщением об успехе (необязательно)
    header("Location: your-website.com/thankyou.html");
}
?>