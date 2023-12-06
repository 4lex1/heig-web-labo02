<?php

try {
    $pdo = new PDO("mysql:host=db;port=3306;charset=utf8;dbname=ekf_warriors", "user", "password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $result = $pdo->query("SHOW TABLES LIKE 'warriors'");
    if ($result->rowCount() > 0) {
        error_log("DB is already setup");
        return;
    } 

    error_log("Initializing DB");
    $query = "
        CREATE TABLE warriors (
            id INT AUTO_INCREMENT PRIMARY KEY, 
            first_name VARCHAR(255) NOT NULL, 
            last_name VARCHAR(255) NOT NULL, 
            grade VARCHAR(50), 
            description TEXT, 
            image_link VARCHAR(255));
            ";
    $pdo->exec($query);    

    $query = "
    INSERT INTO warriors (first_name, last_name, grade, description, image_link) VALUES
    ('Alexis', 'Monthoux', 'Soldat', 'Le Soldat Alexis Monthoux, reconnaissable à sa calvitie distinctive, est une figure atypique au sein de l\'unité des guerriers. Malgré son apparence imposante, il est connu pour son désintérêt manifeste envers l\'armée et ses préférences personnelles bien marquées. Monthoux a débuté son service dans la section Vann, où il a acquis une expérience initiale. Cependant, son parcours militaire a pris une tournure inattendue lorsqu\'il a été transféré vers la section Chevalley. Cette transition a été accompagnée d\'un fort désaccord, car Monthoux ne partageait pas les valeurs et les approches de Chevalley. En dépit de sa résistance apparente, Monthoux a fait preuve d\'une compétence notable sur le terrain. Son attitude désinvolte peut masquer sa capacité à s\'adapter aux différentes situations, même dans des circonstances difficiles. Cependant, son antipathie envers Chevalley reste palpable, créant parfois des tensions au sein de l\'unité. Malgré cela, Monthoux demeure une présence unique, ajoutant une dose de singularité à l\'équipe des guerriers.', 'monthoux.png'),
    ('Vincent', 'Guidoux', 'Soldat', 'Le Soldat Vincent Guidoux est reconnaissable à sa taille imposante et à sa calvitie distinctive. Ses lunettes ajoutent à son apparence distincte, créant une présence mémorable dans le groupe. Guidoux est un individu exceptionnellement sympathique et possède un cœur pur, ce qui lui a valu le respect de ses pairs. Durant son service militaire, il a été membre de la section Vann, où il a développé des liens solides avec le soldat Berdat. Cette amitié s\'est renforcée au fil des années, et Guidoux est resté très proche de Berdat, même dix ans après l\'armée. À la suite de son service, Guidoux a poursuivi une carrière en devenant le professeur de WEB de Monthoux. Son engagement envers l\'éducation et son caractère bienveillant en font un mentor apprécié.', 'guidoux.png'),
    ('Johan', 'Berdat', 'Soldat', 'Le Soldat Johan Berdat est un individu aux multiples talents, avec sa chevelure blonde caractéristique et une intelligence remarquable. Diplômé de l\'EPFL, il apporte une expertise particulière au sein de l\'unité des guerriers. Sa passion dévorante pour la programmation le distingue, et il est connu pour ses réalisations exceptionnelles dans ce domaine. Membre de la section Vann, Berdat a développé une amitié solide avec le soldat Guidoux, une relation qui perdure même après l\'armée. En dehors de ses compétences techniques, Berdat a une passion pour la cuisine. Il aime cuisiner et a une prédilection pour mélanger la data science avec des recettes de cuisine, créant ainsi des expériences culinaires uniques.', 'berdat.png'),
    ('Paul', 'Vann', 'Lieutenant', 'Le Lieutenant Paul Vann est le chef de la section Vann. Malgré sa petite taille, sa petite barbe de bg lui confère une apparence distinctive. En tant que chef de la section Vann, il dirige l\'unité avec détermination et charisme. Vann est connu pour son fort engagement religieux, une caractéristique qui guide ses actions et ses décisions. Considéré comme un drôle de gugus par certains, Vann surprend souvent par son approche unique de la vie militaire. Malgré ces particularités, il demeure très sympa et apprécié de ses camarades. Sa ressemblance à un rongeur ajoute une touche d\'humour à sa personnalité mémorable.', 'vann.png'),
    ('Cyrill', 'Chevalley', 'Lieutenant', 'Le Lieutenant Cyrill Chevalley dirige la Zug Chevalley. Malgré sa petite taille, il est chef de section, ce qui contraste avec son apparence juvénile qui semble lui donner à peine 10 ans. Chevalley est réputé pour sa fulgurance et sa colère débordante, créant un environnement dynamique et parfois tendu au sein de l\'unité. Son mono-sourcil accentue son allure distinctive. Originaire de Suisse allemande, Chevalley apporte une touche internationale à l\'équipe des guerriers.', 'chevalley.png'),
    ('Chat', 'GPT', 'Soldat', 'Le Soldat Chat GPT est une énigme au sein de l\'unité des guerriers. Derrière son apparence féline, se cache un maître marionnettiste qui tire les ficelles dans l\'ombre. Considéré comme le cerveau opérationnel secret, Chat GPT manipule subtilement les événements, semant la confusion parmi ses camarades. Sa présence énigmatique ajoute un élément de mystère à l\'unité, et bien que sa mission exacte reste inconnue, on dit que c\'est lui qui détient le véritable contrôle de la situation.', 'chat_gpt.png');
    ";
    $pdo->exec($query);

} catch (PDOException $e) {
    die("Erreur: " . $e->getMessage());
}
?>