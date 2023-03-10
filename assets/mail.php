<?php



    // Only process POST reqeusts.

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the form fields and remove MORALspace.

        $name = strip_tags(trim($_POST["name"]));

				$name = str_replace(array("\r","\n"),array(" "," "),$name);

        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);


        $message = trim($_POST["message"]);



        // Check that data was sent to the mailer.

        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Set a 400 (bad request) response code and exit.

            http_response_code(400);

            echo "Por favor preencha o formulário novamente.";

            exit;

        }



        // Set the recipient email address.

        // FIXME: Update this to your desired email address.

        $recipient = "caio.valdoveste@outlook.com.br";



        // Set the email subject.

        $sender = "Novo contato de $name";



        //Email Header

        $head = " /// STTHEMES \\\ ";



        // Build the email content.

        $email_content = "$head\n\n\n";

        $email_content .= "Nome: $name\n";

        $email_content .= "Email: $email\n\n";

        $email_content .= "Mensagem:\n$message\n";



        // Build the email headers.

        $email_headers = "De: $name <$email>";



        // Send the email.

        if (mail($recipient, $sender, $email_content, $email_headers)) {

            // Set a 200 (okay) response code.

            http_response_code(200);

            echo "Obrigdo! Sua mensagem foi enviada.";

        } else {

            // Set a 500 (internal server error) response code.

            http_response_code(500);

            echo "Algo deu errado não conseguimos enviar sua mensagem.";

        }



    } else {

        // Not a POST request, set a 403 (forbidden) response code.

        http_response_code(403);

        echo "Houve um problema com o seu envio, por favor tente novamente.";

    }



?>

