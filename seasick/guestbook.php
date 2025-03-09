<?php
header("Content-Type: text/html; charset=UTF-8"); // Richtige Zeichencodierung setzen

$file = 'guestbook.json';

// Falls die Datei nicht existiert, erstelle sie
if (!file_exists($file)) {
    file_put_contents($file, json_encode([]));
}

// Lade bestehende Einträge
$data = json_decode(file_get_contents($file), true);
if (!is_array($data)) {
    $data = []; // Falls JSON beschädigt ist, setze leeres Array
}

// Falls Formular abgesendet wurde
if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['name']) && !empty($_POST['message'])) {
    $newEntry = [
        'name' => htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'),
        'message' => htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'),
    ];
    
    $data[] = $newEntry;

    // Speichern in die Datei
    file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    // Zurück zur Hauptseite nach dem Absenden
    header("Location: seasick.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gästebuch - Seasick</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Gästebuch</h1>
        <a href="seasick.html" class="back-button">Zurück</a>
    </header>

    <section class="guestbook">
        <h2>Tell us your Seasick moment and how you left the ship.</h2>
        
        <form action="guestbook.php" method="post">
            <input type="text" name="name" placeholder="Dein Name" required>
            <textarea name="message" placeholder="Deine Nachricht" required></textarea>
            <button type="submit">Absenden</button>
        </form>

        <h2>Einträge:</h2>
        <div class="entries">
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $entry): ?>
                    <div class="entry">
                        <strong><?= htmlspecialchars($entry['name'], ENT_QUOTES, 'UTF-8') ?>:</strong>
                        <p><?= nl2br(htmlspecialchars($entry['message'], ENT_QUOTES, 'UTF-8')) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Noch keine Einträge. Sei der Erste!</p>
            <?php endif; ?>
        </div>
    </section>

</body>
</html>
