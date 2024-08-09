<?php
// Database connection
try {
    $pdo = new PDO('mysql:host=localhost;dbname=gsm_manager;port=3307', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Query to fetch data
$sqlReport = "SELECT * FROM entite WHERE id_entite != 1";
$resultReport = $pdo->query($sqlReport);

$chartData = [];

if ($resultReport->rowCount() > 0) {
    while ($rowReport = $resultReport->fetch(PDO::FETCH_ASSOC)) {
        $idEntite = $rowReport['id_entite'];
        $nomEntite = ucwords($rowReport['nom_entite']);

        // Fetch personnel data
        $sqlpersonnel = "SELECT * FROM personnel WHERE entite = ?";
        $stmtPersonnel = $pdo->prepare($sqlpersonnel);
        $stmtPersonnel->execute([$idEntite]);

        $voixCount = 0;
        $dataCount = 0;

        while ($rowPersonnel = $stmtPersonnel->fetch(PDO::FETCH_ASSOC)) {
            $idPersonnel = $rowPersonnel['id_personnel'];

            // Count Voix
            $sqlVoix = "SELECT COUNT(*) FROM assoc_pers, puce 
                        WHERE assoc_pers.personnel = ? 
                        AND assoc_pers.puce = puce.id_puce 
                        AND puce.type_puce = 'voix'";
            $stmtVoix = $pdo->prepare($sqlVoix);
            $stmtVoix->execute([$idPersonnel]);
            $voixCount += $stmtVoix->fetchColumn();

            // Count Data
            $sqlData = "SELECT COUNT(*) FROM assoc_pers, puce 
                        WHERE assoc_pers.personnel = ? 
                        AND assoc_pers.puce = puce.id_puce 
                        AND puce.type_puce = 'data'";
            $stmtData = $pdo->prepare($sqlData);
            $stmtData->execute([$idPersonnel]);
            $dataCount += $stmtData->fetchColumn();
        }

        // Append to chart data if at least one piece is taken
        if ($voixCount > 0 || $dataCount > 0) {
            $chartData[] = [
                'nom_entite' => $nomEntite,
                'voix' => $voixCount,
                'data' => $dataCount,
            ];
        }
    }
}

// Limit to 5 entities
$chartData = array_slice($chartData, 0, 5);

header('Content-Type: application/json');
echo json_encode($chartData);
?>