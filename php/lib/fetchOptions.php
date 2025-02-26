<?php
function generateOptions($table)
{
    $host = "localhost";
    $user = "root";
    $password = "mysql";
    $dbname = "eldenring";

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Definizione della query in base alla tabella
        switch ($table) {
            case 'Effetti':
                $query = "SELECT nome as id FROM effettistato";
                break;
            case 'Tipi':
                $query = "SELECT tipologia as id FROM Statistiche";
                break;
            case 'Attributi':
                $query = "SELECT id_attributo as id, nome FROM Attributi";
                break;
            case 'Categorie':
                $query = "SELECT id_categoria as id, nome FROM Categorie";
                break;
            default:
                return "";
        }

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $options = "";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            if (isset($row['id']) && isset($row['nome'])) {
                // Usa l'ID per il valore e il nome per il testo da visualizzare
                $options .= "<option name='" . $table . "' value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
            } elseif (isset($row['nome'])) {
                // Quando c'è solo "id", usa lo stesso valore per "value" e "testo"
                $options .= "<option name='" . $table . "' value='" . $row['nome'] . "'>" . $row['nome'] . "</option>";
            } else {
                $options .= "<option name='" . $table . "' value='" . $row['id'] . "'>" . $row['id'] . "</option>";
            }
        }

        return $options;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

?>
