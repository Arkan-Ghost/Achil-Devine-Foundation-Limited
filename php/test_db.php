<?php
require_once 'db_connect.php';

echo "<h2>Test de connexion à la base de données</h2>";

try {
    $db = Database::getInstance();
    $conn = $db->getConnection();
    echo "<p style='color:green'>✅ Connexion à la base de données réussie !</p>";
    
    // Tester la table newsletter_subscribers
    $testSql = "SELECT COUNT(*) as count FROM newsletter_subscribers";
    $result = $conn->query($testSql);
    $row = $result->fetch_assoc();
    echo "<p>📊 Nombre d'abonnés newsletter : " . $row['count'] . "</p>";
    
    // Lister toutes les tables
    $tablesSql = "SHOW TABLES";
    $tables = $conn->query($tablesSql);
    echo "<p>📋 Tables dans la base de données :</p><ul>";
    while ($table = $tables->fetch_array()) {
        echo "<li>" . $table[0] . "</li>";
    }
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color:red'>❌ Erreur : " . $e->getMessage() . "</p>";
}
?>