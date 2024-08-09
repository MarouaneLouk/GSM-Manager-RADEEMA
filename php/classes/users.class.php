<?php
    Class Users extends Dbh {
        protected function checkLogin($login,$pwd){
            $parts=explode(".",$login);
            $name_surname = $parts[0];
            $gsm_suffix = $parts[1];
            if($gsm_suffix === "gsm"){
                $name_surname_parts = preg_split('/(?<=\D)(?=\d)/', $name_surname);
                if (count($name_surname_parts) == 2) {
                    $name = $name_surname_parts[0];
                    $number = $name_surname_parts[1];
                    $_SESSION["IdUser_for_login"]=$number;
                    $name_parts = explode('_',$name);
                    $firstname = $name_parts[0];
                    $lastname = $name_parts[1];
                    if(strlen($number) === 3){
                        $number = ltrim($number, '0');
                        $number = (int)$number;
                        $_SESSION["Id_User"]=$number;
                        $sql = "SELECT * FROM user WHERE nom_utilisateur = ? and prenom_utilisateur = ? and mot_passe = ? and id_login = ?";
                        $stmt = $this->connect()->prepare($sql);
                        $stmt->execute([$firstname,$lastname,$pwd,$number]);
                        $nbLignes = $stmt->rowCount();
                        return $nbLignes;
                    }
                    else{
                        return "Incorrect login or password!";
                    }
                } else {
                    return "Incorrect login or password!";
                }
            }
            else{
                return "Incorrect login or password!";
            }
        }
        protected function getInfoById($id){
            $sql = "SELECT * FROM user WHERE id_login = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            return $stmt;
        }
        protected function ModifyUserPwd($newPwd,$id){
            $sql = "UPDATE user SET mot_passe = ? WHERE id_login = ?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$newPwd,$id]);
            return $stmt;
        }
        protected function userTable($id) {
            $sql = "SELECT * FROM user WHERE id_login=?";
            $result = $this->connect()->prepare($sql);
            $result->execute(array($id));
            if($result->rowCount() > 0) {
                $row = $result->fetch();
                if($row["profil"]==="admin"){
                    $sql = "SELECT * FROM user";
                    $result = $this->connect()->query($sql);
                
                    if ($result->rowCount() > 0) {
                        // Output data of each row
                        $popupCounter = 1;
                        while ($row = $result->fetch()) {
                            // Output the table row
                            echo "<tr>
                                    <td><input class='row-checkbox' name='checkId[]' value='" . $row['id_login'] . "' type='checkbox'></td>
                                    <td>" . str_pad($row["id_login"], 3, '0', STR_PAD_LEFT) . "</td>
                                    <td>" . $row["nom_utilisateur"] . " " . $row["prenom_utilisateur"] . "</td>
                                    <td>" . $row["mot_passe"] . "</td>
                                    <td>" . ucwords($row["profil"]) . "</td>
                                    <td>" . $row["observation"] . "</td>
                                    <td><span class='view-more-btn' data-popup='viewMorePopup" . $popupCounter . "'>View More</span></td>
                                </tr>";
                
                            // Output the popup content
                            echo "<div id='viewMorePopup" . $popupCounter . "' class='popup-overlay'>
                                    <div class='popup-content'>
                                        <div class='popup-header'>
                                            <h2>User Details</h2>
                                            <button class='close-btn'>
                                                <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>
                                                    <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                                    <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                                    <g id='SVGRepo_iconCarrier'>
                                                        <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/>
                                                        <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class='popup-body'>
                                            <p><strong>ID:</strong> " . str_pad($row["id_login"], 3, '0', STR_PAD_LEFT) . "</p>
                                            <p><strong>Name:</strong> " . $row["nom_utilisateur"] . " " . $row["prenom_utilisateur"] . "</p>
                                            <p><strong>Password:</strong> " . $row["mot_passe"] . "</p>
                                            <p><strong>Profile:</strong> " . ucwords($row["profil"]) . "</p>
                                            <p><strong>Observation:</strong> " . $row["observation"] . "</p>
                                        </div>
                                    </div>
                                </div>";
                
                            $popupCounter++; // Increment the counter for the next popup
                        }
                    }
                }
                else if($row["profil"]==="operateur" || $row["profil"]==="observateur"){
                    $sql = "SELECT * FROM user";
                    $result = $this->connect()->query($sql);
                
                    if ($result->rowCount() > 0) {
                        // Output data of each row
                        $popupCounter = 1; // Counter to create unique IDs for popups
                        while ($row = $result->fetch()) {
                            // Output the table row
                            echo "<tr>
                                    <td><input class='row-checkbox' name='checkId[]' value='" . $row['id_login'] . "' type='checkbox'></td>
                                    <td>" . $row["nom_utilisateur"] . " " . $row["prenom_utilisateur"] . "</td>
                                    <td>" . ucwords($row["profil"]) . "</td>
                                    <td>" . $row["observation"] . "</td>
                                    <td><span class='view-more-btn' data-popup='viewMorePopup" . $popupCounter . "'>View More</span></td>
                                </tr>";
                
                            // Output the popup content
                            echo "<div id='viewMorePopup" . $popupCounter . "' class='popup-overlay'>
                                    <div class='popup-content'>
                                        <div class='popup-header'>
                                            <h2>User Details</h2>
                                            <button class='close-btn'>
                                                <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>
                                                    <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                                    <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                                    <g id='SVGRepo_iconCarrier'>
                                                        <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/>
                                                        <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/>
                                                    </g>
                                                </svg>
                                            </button>
                                        </div>
                                        <div class='popup-body'>
                                            <p><strong>Name:</strong> " . $row["nom_utilisateur"] . " " . $row["prenom_utilisateur"] . "</p>
                                            <p><strong>Profile:</strong> " . ucwords($row["profil"]) . "</p>
                                            <p><strong>Observation:</strong> " . $row["observation"] . "</p>
                                        </div>
                                    </div>
                                </div>";
                
                            $popupCounter++; // Increment the counter for the next popup
                        }
                    }
                }
            } else {
                echo "<br><br>0 results";
            }
            return $result->rowCount();
        }
        

        protected function insertUser($nomUser,$prenomUser,$motPasse,$profil,$observation){
            $sql = "INSERT INTO user(nom_utilisateur,prenom_utilisateur,mot_passe,profil,observation) VALUES(?,?,?,?,?)";
            try {
                $insertionUser = $this->connect()->prepare($sql);
                $insertionUser->execute(array($nomUser,$prenomUser,$motPasse,$profil,$observation));
                $_SESSION['userError'] = "the user added successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
                exit;
            } catch(Exception $e) {
                $_SESSION['userError'] = "the user is not added";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
                exit;
            }
        }
        protected function insertDotation($puce,$solde,$dateDotation,$observation){
            $sql = "INSERT INTO dotation(puce,solde,date_dotation,observation) VALUES(?,?,?,?)";
            try {
                $insertionUser = $this->connect()->prepare($sql);
                $insertionUser->execute(array($puce,$solde,$dateDotation,$observation));
                $_SESSION['crDotationError'] = "the dotation added successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
                exit;
            } catch(Exception $e) {
                $_SESSION['crDotationError'] = "the dotation is not added";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
                exit;
            }
        }
        protected function insertPuce($numero,$code,$typePuce,$observation){
            $sql = "INSERT INTO puce(numero,code,type_puce,etat,observation) VALUES(?,?,?,?,?)";
            try {
                $insertionUser = $this->connect()->prepare($sql);
                $insertionUser->execute(array($numero,$code,$typePuce,'désaffecter',$observation));
                $_SESSION['crPuceError'] = "the puce added successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
                exit;
            } catch(Exception $e) {
                $_SESSION['crPuceError'] = "the puce is not added";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
                exit;
            }
        }
        protected function insertEntite($nomEntite,$typeEntite,$entiteMere){
            $sql = "INSERT INTO entite(nom_entite,type_entite,entite_mere) VALUES(?,?,?)";
            try {
                $insertionUser = $this->connect()->prepare($sql);
                $insertionUser->execute(array($nomEntite,$typeEntite,$entiteMere));
                $_SESSION['crEntiteError'] = "the entite added successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
                exit;
            } catch(Exception $e) {
                $_SESSION['crEntiteError'] = "the entite is not added";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
                exit;
            }
        }
        protected function insertPer($matricule,$userStatus,$nom,$prenom,$entite,$observation){
            $sql = "INSERT INTO personnel(matricule,user_status,nom,prenom,entite,observation) VALUES(?,?,?,?,?,?)";
            try {
                $insertionUser = $this->connect()->prepare($sql);
                $insertionUser->execute(array($matricule,$userStatus,$nom,$prenom,$entite,$observation));
                $_SESSION['crPerError'] = "the personnel added successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
                exit;
            } catch(Exception $e) {
                $_SESSION['crPerError'] = "the personnel is not added";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
                exit;
            }
        }

        protected function insertAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation){
            $sql = "INSERT INTO assoc_pers(personnel,puce,date_affectation,date_desaffectation) VALUES(?,?,?,?)";
            try {
                $insertionAffpuce = $this->connect()->prepare($sql);
                $insertionAffpuce->execute(array($personnel,$puce,$dateAffectation,$dateDesaffectation));
                $sqletat = "UPDATE puce SET etat='affecter' WHERE id_puce=?";
                $changeEtat = $this->connect()->prepare($sqletat);
                $changeEtat->execute(array($puce));
                $_SESSION['crAffpuceError'] = "the affectation added successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
                exit;
            } catch(Exception $e) {
                $_SESSION['crAffpuceError'] = "the affectation is not added";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
                exit;
            }
        }

        protected function entiteTable(){
            $sql = "SELECT * FROM entite WHERE id_entite != 1";
            $result = $this->connect()->query($sql);
        
            if ($result->rowCount() > 0) {
                while($row = $result->fetch()) {
                    // Generate unique IDs for each row's popup
                    $popupId = 'viewMorePopup' . $row['id_entite'];
                    echo "<tr>
                            <td><input name='checkId[]' value='" . $row['id_entite'] . "' type='checkbox'></td>
                            <td>" . ucwords($row["nom_entite"]) . "</td>
                            <td>" . ucwords($row["type_entite"]) . "</td>";
                            if($row["entite_mere"] === 1){
                                echo "<td></td>";
                            }
                            else{
                                $sqlchild = "SELECT * FROM entite WHERE id_entite = ?";
                                $resultchild = $this->connect()->prepare($sqlchild);
                                $resultchild->execute(array($row["entite_mere"]));
                                $rowchild = $resultchild->fetch();
                                echo "<td>" . ucwords($rowchild['nom_entite']) . "</td>";
                            }
                            echo "<td><span class='view-more-btn' data-popup='$popupId'>View More</span></td>
                        </tr>
                        <div id='$popupId' class='popup-overlay' style='display:none;'>
                            <div class='popup-content'>
                                <div class='popup-header'>
                                    <h2>Entité Details</h2>
                                    <button class='close-btn'>
                                        <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>

                                        <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                        
                                        <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                        
                                        <g id='SVGRepo_iconCarrier'> <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/> <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/> </g>
                                        
                                    </svg>
                                    </button>
                                </div>
                                <div class='popup-body'>
                                    <p><strong>Nom Entité:</strong> " . ucwords($row["nom_entite"]) . "</p>
                                    <p><strong>Type Entité:</strong> " . ucwords($row["type_entite"]) . "</p>
                                    <p><strong>Id Entité Mère:</strong> " . $row["entite_mere"] . "</p>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<br><br>0 results";
            }
            return $result->rowCount();
        }
        
        protected function puceTable() {
            $sql = "SELECT * FROM puce";
            $result = $this->connect()->query($sql);
        
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) {
                    // Generate unique IDs for each row's popup
                    $popupId = 'viewMorePopup' . $row['id_puce'];
                    echo "<tr>
                            <td><input name='checkId[]' value='" . $row['id_puce'] . "' type='checkbox'></td>
                            <td>" . $row["numero"] . "</td>
                            <td>" . $row["code"] . "</td>
                            <td>" . ucwords($row["type_puce"]) . "</td>
                            <td>" . ucwords($row["etat"]) . "</td>
                            <td>" . $row["observation"] . "</td>
                            <td><span class='view-more-btn' data-popup='$popupId'>View More</span></td>
                        </tr>
                        <div id='$popupId' class='popup-overlay' style='display:none;'>
                            <div class='popup-content'>
                                <div class='popup-header'>
                                    <h2>Puce Details</h2>
                                    <button class='close-btn'>
                                        <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>
                                            <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                            <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                            <g id='SVGRepo_iconCarrier'>
                                                <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/>
                                                <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class='popup-body'>
                                    <p><strong>Numero:</strong> " . $row["numero"] . "</p>
                                    <p><strong>Code:</strong> " . $row["code"] . "</p>
                                    <p><strong>Type:</strong> " . ucwords($row["type_puce"]) . "</p>
                                    <p><strong>État:</strong> " . ucwords($row["etat"]) . "</p>
                                    <p><strong>Observation:</strong> " . $row["observation"] . "</p>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<br><br>0 results";
            }
            return $result->rowCount();
        }
        
        protected function affpuceTable(){
            $sqlAssocPers = "SELECT * FROM assoc_pers";
            $resultAssocPers = $this->connect()->query($sqlAssocPers);
            if ($resultAssocPers->rowCount() > 0) {
                while($rowAssocPers = $resultAssocPers->fetch()) {
                    $sqlpersonnel = "SELECT * FROM personnel WHERE id_personnel = ?";
                    $resultpersonnel = $this->connect()->prepare($sqlpersonnel);
                    $resultpersonnel->execute(array($rowAssocPers["personnel"]));
                    $rowpersonnel = $resultpersonnel->fetch();
                    $sqlPuce = "SELECT * FROM puce WHERE id_puce = ?";
                    $resultPuce = $this->connect()->prepare($sqlPuce);
                    $resultPuce->execute(array($rowAssocPers["puce"]));
                    $rowPuce = $resultPuce->fetch();
        
                    // Generate unique IDs for each row's popup
                    $popupId = 'viewMorePopup' . $rowAssocPers['puce'];
        
                    echo "<tr>
                        <td><input name='checkId[]' value='" . $rowAssocPers['puce'] . "' type='checkbox' ></td>
                        <td>".$rowpersonnel['matricule']."</td>
                        <td>".ucwords($rowpersonnel['nom'])."</td>
                        <td>".ucwords($rowpersonnel['prenom'])."</td>
                        <td>".$rowPuce['code']."</td>
                        <td>".ucwords($rowPuce['etat'])."</td>
                        <td>".ucwords($rowPuce['type_puce'])."</td>
                        <td>".$rowAssocPers['date_affectation']."</td>
                        <td>".$rowAssocPers['date_desaffectation']."</td>";
        
                        if($rowpersonnel['entite'] === 1){
                            echo "<td></td>";
                        } else {
                            $sqlentite = "SELECT * FROM entite WHERE id_entite = ?";
                            $resultentite = $this->connect()->prepare($sqlentite);
                            $resultentite->execute(array($rowpersonnel['entite']));
                            $rowentite = $resultentite->fetch();
                            echo "<td>".$rowentite['nom_entite']."</td>";
                        }
        
                        echo "<td><span class='view-more-btn' data-popup='$popupId'>View More</span></td>
                    </tr>
                    <div id='$popupId' class='popup-overlay' style='display:none;'>
                        <div class='popup-content'>
                            <div class='popup-header'>
                                <h2>Details</h2>
                                <button class='close-btn'>
                                    <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>
                                        <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                        <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                        <g id='SVGRepo_iconCarrier'>
                                            <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/>
                                            <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class='popup-body'>
                                <p><strong>Matricule:</strong> " . $rowpersonnel['matricule'] . "</p>
                                <p><strong>Nom:</strong> " . ucwords($rowpersonnel['nom']) . "</p>
                                <p><strong>Prénom:</strong> " . ucwords($rowpersonnel['prenom']) . "</p>
                                <p><strong>Code Puce:</strong> " . $rowPuce['code'] . "</p>
                                <p><strong>État Puce:</strong> " . ucwords($rowPuce['etat']) . "</p>
                                <p><strong>Type Puce:</strong> " . ucwords($rowPuce['type_puce']) . "</p>
                                <p><strong>Date Affectation:</strong> " . $rowAssocPers['date_affectation'] . "</p>
                                <p><strong>Date Désaffectation:</strong> " . $rowAssocPers['date_desaffectation'] . "</p>";
        
                                echo "<p><strong>Id Entité:</strong> " . $rowpersonnel['entite'] . "</p>";
        
                            echo "</div>
                        </div>
                    </div>";
                }
            } else {
                echo "<br><br>0 results";
            }
            return $resultAssocPers->rowCount();
            $this->connect()->close();
        }
        protected function ReportTable(){
            $sqlReport = "SELECT * FROM entite WHERE id_entite != 1";
            $resultReport = $this->connect()->query($sqlReport);
            if ($resultReport->rowCount() > 0) {
                while($rowReport = $resultReport->fetch()) {
                    // Generate unique IDs for each row's popup
                    $popupId = 'viewMorePopup' . $rowReport['id_entite'];
        
                    echo "<tr>
                        <td><input type='checkbox'></td>
                        <td>".ucwords($rowReport['nom_entite'])."</td>
                        <td>".ucwords($rowReport['type_entite'])."</td>";
                        $sqlpersonnel = "SELECT * FROM personnel WHERE entite = ?";
                        $resultpersonnel = $this->connect()->prepare($sqlpersonnel);
                        $resultpersonnel->execute(array($rowReport['id_entite']));
                        $i=0;
                        $j=0;
                        while($rowpersonnel = $resultpersonnel->fetch()){
                            $sqlAssocPersi = "SELECT * FROM assoc_pers,puce WHERE assoc_pers.personnel = ? AND assoc_pers.puce = puce.id_puce AND puce.type_puce='voix'";
                            $resultAssocPersi = $this->connect()->prepare($sqlAssocPersi);
                            $resultAssocPersi->execute(array($rowpersonnel['id_personnel']));
                            $i=$i+($resultAssocPersi->rowCount());
                            $sqlAssocPersj = "SELECT * FROM assoc_pers,puce WHERE assoc_pers.personnel = ? AND assoc_pers.puce = puce.id_puce AND puce.type_puce='data'";
                            $resultAssocPersj = $this->connect()->prepare($sqlAssocPersj);
                            $resultAssocPersj->execute(array($rowpersonnel['id_personnel']));
                            $j=$j+($resultAssocPersj->rowCount());
                        }
                        echo "<td>". $i ."</td>
                        <td>". $j ."</td>";

        
                        if($rowReport['entite_mere'] === 1){
                            echo "<td></td>";
                        } else {
                            $sqlentite = "SELECT * FROM entite WHERE id_entite = ?";
                            $resultentite = $this->connect()->prepare($sqlentite);
                            $resultentite->execute(array($rowReport['entite_mere']));
                            $rowentite = $resultentite->fetch();
                            echo "<td>". ucwords($rowentite['nom_entite']) ."</td>";
                        }
        
                        echo "<td><span class='view-more-btn' data-popup='$popupId'>View More</span></td>
                    </tr>
                    <div id='$popupId' class='popup-overlay' style='display:none;'>
                        <div class='popup-content'>
                            <div class='popup-header'>
                                <h2>Details</h2>
                                <button class='close-btn'>
                                    <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>
                                        <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                        <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                        <g id='SVGRepo_iconCarrier'>
                                            <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/>
                                            <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/>
                                        </g>
                                    </svg>
                                </button>
                            </div>
                            <div class='popup-body'>
                                <p><strong>Nom Entité:</strong> " . ucwords($rowReport['nom_entite']) . "</p>
                                <p><strong>Type Entité:</strong> " . ucwords($rowReport['type_entite']) . "</p>
                                <p><strong>Nombre de puces voix:</strong> " . $i . "</p>
                                <p><strong>Nombre de puces data:</strong> " . $j . "</p>
                                <p><strong>Id Entité Mère:</strong> " . ucwords($rowReport['entite_mere']) . "</p>";
        
                            echo "</div>
                        </div>
                    </div>";
                }
            } else {
                echo "<br><br>0 results";
            }
            return $resultReport->rowCount();
            $this->connect()->close();
        }   
        protected function dotationTable() {
            $sql = "SELECT * FROM dotation";
            $result = $this->connect()->query($sql);
        
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) {
                    // Generate unique ID for each popup
                    $popupId = 'viewMorePopup' . $row['id_dotation'];
        
                    echo "<tr>
                            <td><input name='checkId[]' value='" . $row['id_dotation'] . "' type='checkbox'></td>";
                            $sqlpucecode = "SELECT * FROM puce where id_puce=?";
                            $resultpucecode = $this->connect()->prepare($sqlpucecode);
                            $resultpucecode->execute(array($row["puce"]));
                            $rowpucecode = $resultpucecode->fetch();
                            echo "<td>" . $rowpucecode["code"] . "</td>";
                            echo "<td>" . $row["solde"] . "</td>
                            <td>" . $row["date_dotation"] . "</td>
                            <td>" . $row["observation"] . "</td>
                            <td><span class='view-more-btn' data-popup='$popupId'>View More</span></td>
                        </tr>
                        <div id='$popupId' class='popup-overlay' style='display:none;'>
                            <div class='popup-content'>
                                <div class='popup-header'>
                                    <h2>Dotation Details</h2>
                                    <button class='close-btn'>
                                        <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>
                                            <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                            <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                            <g id='SVGRepo_iconCarrier'>
                                                <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/>
                                                <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class='popup-body'>
                                    <p><strong>Id Puce:</strong> " . $row["puce"] . "</p>
                                    <p><strong>Solde:</strong> " . $row["solde"] . "</p>
                                    <p><strong>Date Dotation:</strong> " . $row["date_dotation"] . "</p>
                                    <p><strong>Observation:</strong> " . $row["observation"] . "</p>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<br><br>0 results";
            }
            return $result->rowCount();
        }
        
        protected function personnelTable() {
            $sql = "SELECT * FROM personnel";
            $result = $this->connect()->query($sql);
        
            if ($result->rowCount() > 0) {
                while ($row = $result->fetch()) {
                    // Generate unique ID for each popup
                    $popupId = 'viewMorePopup' . $row['matricule'];
        
                    // Determine status class and text
                    $statusClass = $row["user_status"] === "active" ? "active" : "inactive";
                    $statusText = $row["user_status"] === "active" ? "Active" : "Inactive";
        
                    echo "<tr>
                            <td><input name='checkId[]' value='" . $row['id_personnel'] . "'  type='checkbox' ></td>
                            <td>" . $row["matricule"] . "</td>
                            <td><span class='status $statusClass'>$statusText</span></td>
                            <td>" . ucwords($row["nom"]) . "</td>
                            <td>" . ucwords($row["prenom"]) . "</td>";
                            if($row["entite"] === 1){
                                echo "<td></td>";
                            }
                            else{
                                $sqlchild = "SELECT * FROM entite WHERE id_entite = ?";
                                $resultchild = $this->connect()->prepare($sqlchild);
                                $resultchild->execute(array($row["entite"]));
                                $rowchild = $resultchild->fetch();
                                echo "<td>" . ucwords($rowchild['nom_entite']) . "</td>";
                            }
                            echo"<td>" . $row["observation"] . "</td>
                            <td><span class='view-more-btn' data-popup='$popupId'>View More</span></td>
                        </tr>
                        <div id='$popupId' class='popup-overlay' style='display:none;'>
                            <div class='popup-content'>
                                <div class='popup-header'>
                                    <h2>Personnel Details</h2>
                                    <button class='close-btn'>
                                        <svg width='25px' height='25px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg' stroke='#000000' stroke-width='0.00024000000000000003'>
                                            <g id='SVGRepo_bgCarrier' stroke-width='0'/>
                                            <g id='SVGRepo_tracerCarrier' stroke-linecap='round' stroke-linejoin='round' stroke='#CCCCCC' stroke-width='0.048'/>
                                            <g id='SVGRepo_iconCarrier'>
                                                <path opacity='0.5' d='M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z' fill='#546b52'/>
                                                <path d='M8.96967 8.96967C9.26256 8.67678 9.73744 8.67678 10.0303 8.96967L12 10.9394L13.9697 8.96969C14.2626 8.6768 14.7374 8.6768 15.0303 8.96969C15.3232 9.26258 15.3232 9.73746 15.0303 10.0304L13.0607 12L15.0303 13.9696C15.3232 14.2625 15.3232 14.7374 15.0303 15.0303C14.7374 15.3232 14.2625 15.3232 13.9696 15.0303L12 13.0607L10.0304 15.0303C9.73746 15.3232 9.26258 15.3232 8.96969 15.0303C8.6768 14.7374 8.6768 14.2626 8.96969 13.9697L10.9394 12L8.96967 10.0303C8.67678 9.73744 8.67678 9.26256 8.96967 8.96967Z' fill='#546b52'/>
                                            </g>
                                        </svg>
                                    </button>
                                </div>
                                <div class='popup-body'>
                                    <p><strong>Matricule:</strong> " . $row["matricule"] . "</p>
                                    <p><strong>Nom:</strong> " . ucwords($row["nom"]) . "</p>
                                    <p><strong>Prénom:</strong> " . ucwords($row["prenom"]) . "</p>
                                    <p><strong>Id Entité:</strong> " . ucwords($row["entite"]) . "</p>
                                    <p><strong>Observation:</strong> " . $row["observation"] . "</p>
                                </div>
                            </div>
                        </div>";
                }
            } else {
                echo "<br><br>0 results";
            }
            return $result->rowCount();
        }
        
        protected function deleteEntite($extract_id){
            $placeholders = implode(',', array_fill(0, count($extract_id), '?'));
            $sql = "DELETE FROM entite WHERE id_entite IN($placeholders)";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute($extract_id);
                $_SESSION['deleteEntiteError'] = "Data deleted successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['deleteEntiteError'] = "Data not deleted";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
                exit;
            }
        }
        protected function deletePers($extract_id){
            $placeholders = implode(',', array_fill(0, count($extract_id), '?'));
            $sql = "DELETE FROM personnel WHERE id_personnel IN($placeholders)";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute($extract_id);
                $_SESSION['deletePersError'] = "Data deleted successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['deletePersError'] = "Data not deleted";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
                exit;
            }
        }
        protected function deletePuce($extract_id){
            $placeholders = implode(',', array_fill(0, count($extract_id), '?'));
            $sql = "DELETE FROM puce WHERE id_puce IN($placeholders)";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute($extract_id);
                $_SESSION['deletePuceError'] = "Data deleted successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['deletePuceError'] = "Data not deleted";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
                exit;
            }
        }
        protected function deleteAffpuce($extract_id){
            $placeholders = implode(',', array_fill(0, count($extract_id), '?'));
            try {
                $sql = "DELETE FROM assoc_pers WHERE puce IN($placeholders)";
                $result = $this->connect()->prepare($sql);
                $result->execute($extract_id);

                $sql = "UPDATE puce SET etat=? WHERE id_puce IN($placeholders)";
                $result = $this->connect()->prepare($sql);
                $params = array_merge(["désaffecter"], $extract_id);
                $result->execute($params);
                $_SESSION['deleteAffpuceError'] = "Data deleted successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['deleteAffPuceError'] = "Data not deleted";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
                exit;
            }
        }
        protected function deleteDotation($extract_id){
            $placeholders = implode(',', array_fill(0, count($extract_id), '?'));
            $sql = "DELETE FROM dotation WHERE id_dotation IN($placeholders)";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute($extract_id);
                $_SESSION['deleteDotationError'] = "Data deleted successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['deleteDotationError'] = "Data not deleted";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
                exit;
            }
        }
        protected function deleteUser($extract_id){
            $placeholders = implode(',', array_fill(0, count($extract_id), '?'));
            $sql = "DELETE FROM user WHERE id_login IN($placeholders)";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute($extract_id);
                $_SESSION['deleteUserError'] = "Data deleted successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['deleteUserError'] = "Data not deleted";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
                exit;
            }
        }
        protected function ModifyContentEntite($idEntity){
            $sql = "SELECT * FROM entite WHERE id_entite=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idEntity]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
            }
            return $row;
        }
        protected function ModifyContentPers($idPers){
            $sql = "SELECT * FROM personnel WHERE id_personnel=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idPers]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
            }
            return $row;
        }
        protected function ModifyContentPuce($idPuce){
            $sql = "SELECT * FROM puce WHERE id_puce=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idPuce]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
            }
            return $row;
        }
        protected function ModifyContentUser($idUser){
            $sql = "SELECT * FROM user WHERE id_login=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idUser]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
            }
            return $row;
        }
        protected function ModifyContentDotation($idDotation){
            $sql = "SELECT * FROM dotation WHERE id_dotation=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idDotation]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
            }
            return $row;
        }
        protected function ModifyContentAff($idAff){
            $sql = "SELECT * FROM assoc_pers WHERE puce=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idAff]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
            }
            return $row;
        }
        protected function ModifyContentAffByIdPers($idAff){
            $sql = "SELECT * FROM assoc_pers WHERE puce=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idAff]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
                $sqlByIdPers = "SELECT * FROM personnel WHERE id_personnel=?";
                $stmtByIdPers = $this->connect()->prepare($sqlByIdPers);
                $stmtByIdPers->execute([$row['personnel']]);
                if($stmtByIdPers->rowCount() > 0){
                    $rowByIdPers = $stmtByIdPers->fetch();
                }
            }
            return $rowByIdPers;
        }
        protected function ModifyContentAffByIdPuce($idAff){
            $sql = "SELECT * FROM assoc_pers WHERE puce=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$idAff]);
            if($stmt->rowCount() > 0){
                $row = $stmt->fetch();
                $sqlByIdPuce = "SELECT * FROM puce WHERE id_puce=?";
                $stmtByIdPuce = $this->connect()->prepare($sqlByIdPuce);
                $stmtByIdPuce->execute([$row['puce']]);
                if($stmtByIdPuce->rowCount() > 0){
                    $rowByIdPuce = $stmtByIdPuce->fetch();
                }
            }
            return $rowByIdPuce;
        }
        protected function modifyEntite($nomEntite,$typeEntite,$entiteMere,$extract_id){
            $sql = "UPDATE entite SET nom_entite=?,type_entite=?,entite_mere=? WHERE id_entite=?";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute([$nomEntite,$typeEntite,$entiteMere,$extract_id]);
                $_SESSION['modifyEntiteError'] = "Data updated successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['modifyEntiteError'] = "Data not updated";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGentite.php");
                exit;
            }
        }
        protected function modifyPers($matricule,$user_status,$nom,$prenom,$entite,$observation,$extract_id){
            $sql = "UPDATE personnel SET matricule=?,user_status=?,nom=?,prenom=?,entite=?,observation=? WHERE id_personnel=?";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute([$matricule,$user_status,$nom,$prenom,$entite,$observation,$extract_id]);
                $_SESSION['modifyPersError'] = "Data updated successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['modifyPersError'] = "Data not updated";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGper.php");
                exit;
            }
        }
        protected function modifyPuce($numero,$code,$typePuce,$observation,$extract_id){
            $sql = "UPDATE puce SET numero=?,code=?,type_puce=?,observation=? WHERE id_puce=?";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute([$numero,$code,$typePuce,$observation,$extract_id]);
                $_SESSION['modifyPuceError'] = "Data updated successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['modifyPuceError'] = "Data not updated";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGpuce.php");
                exit;
            }
        }
        protected function modifyUser($nomUser,$prenomUser,$motPasse,$profil,$observation,$extract_id){
            $sql = "UPDATE user SET nom_utilisateur=?,prenom_utilisateur=?,mot_passe=?,profil=?,observation=? WHERE id_login=?";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute([$nomUser,$prenomUser,$motPasse,$profil,$observation,$extract_id]);
                $_SESSION['modifyUserError'] = "Data updated successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['modifyUserError'] = "Data not updated";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGuser.php");
                exit;
            }
        }
        protected function modifyDotation($puce,$solde,$dateDotation,$observation,$extract_id){
            $sql = "UPDATE dotation SET puce=?,solde=?,date_dotation=?,observation=? WHERE id_dotation=?";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute([$puce,$solde,$dateDotation,$observation,$extract_id]);
                $_SESSION['modifyDotationError'] = "Data updated successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['modifyDotationError'] = "Data not updated";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabGdotation.php");
                exit;
            }
        }
        protected function modifyAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation,$extract_id){
            $sql = "UPDATE assoc_pers SET puce=?,personnel=?,date_affectation=?,date_desaffectation=? WHERE puce=?";
            try {
                $result = $this->connect()->prepare($sql);
                $result->execute([$puce,$personnel,$dateAffectation,$dateDesaffectation,$extract_id]);
                $_SESSION['modifyAffpuceError'] = "Data updated successfully";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
                exit;
            }
            catch(Exception $e) {
                $_SESSION['modifyAffpuceError'] = "Data not updated";
                header("location: /GSMMANAGERRADEEMA/html/HomePageTabAffpuce.php");
                exit;
            }
        }
        protected function EntiteMere(){
            $sql = "SELECT * FROM entite WHERE entite_mere = 1 AND id_entite != 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            echo '<label for="entiteMere"><span style="color:red">*</span>Entité Mère:</label>
                    <select id="entiteMere" name="entiteMere" required>
                        <option value="1">Entité Mère</option>';
            if($stmt->rowCount() > 0){
                while ($row = $stmt->fetch()) {
                    echo '<option value="' . $row['id_entite'] . '">' . $row['nom_entite'] . '</option>';
                }
            }
            echo '</select>';
        }
        protected function EntiteMereById($id){
            $sql = "SELECT * FROM entite WHERE entite_mere = 1 AND id_entite != ? AND id_entite != 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $sqlById = "SELECT * FROM entite WHERE id_entite = ?";
            $stmtById = $this->connect()->prepare($sqlById);
            $stmtById->execute([$id]);
            if($stmtById->rowCount() > 0){
                $rowId = $stmtById->fetch();
            }
            echo '<label for="entiteMere"><span style="color:red">*</span>Entité Mère:</label>
                    <select id="entiteMere" name="entiteMere" required>
                        <option value="1">Entité Mère</option>';
            if($stmt->rowCount() > 0){
                while ($row = $stmt->fetch()) {
                    $selected = ($rowId && $rowId["entite_mere"] === $row["id_entite"]) ? 'selected' : '';
                    echo '<option value="' . $row['id_entite'] . '" ' . $selected . '>' . $row['nom_entite'] . '</option>';
                }
            }
            echo '</select>';
        }
        protected function Entite(){
            $sql = "SELECT * FROM entite WHERE id_entite != 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            echo '<label for="entite"><span style="color:red">*</span>Entite:</label>
                    <select id="entite" name="entite" required>';
            if($stmt->rowCount() > 0){
                while ($row = $stmt->fetch()) {
                    if($row['entite_mere'] === 1){
                        echo '<option value="' . $row['id_entite'] . '"><b>' . $row['nom_entite'] . '</b></option>';
                    }
                    else{
                        $sqlchild = "SELECT * FROM entite WHERE id_entite = ?";
                        $resultchild = $this->connect()->prepare($sqlchild);
                        $resultchild->execute(array($row["entite_mere"]));
                        $rowchild = $resultchild->fetch();
                        echo '<option value="' . $row['id_entite'] . '">' . ucwords($row['nom_entite']) . '(' .  ucwords($rowchild['nom_entite']) . ')' . '</option>';
                    }
                }
                echo '</select>';
            }
        }
        protected function EntiteById($id){
            $sql = "SELECT * FROM entite WHERE id_entite != 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $sqlById = "SELECT * FROM personnel WHERE id_personnel = ?";
            $stmtById = $this->connect()->prepare($sqlById);
            $stmtById->execute([$id]);
            if($stmtById->rowCount() > 0){
                $rowId = $stmtById->fetch();
            }
            echo '<label for="entite"><span style="color:red">*</span>Entite:</label>
                    <select id="entite" name="entite" required>';
            if($stmt->rowCount() > 0){
                while ($row = $stmt->fetch()) {
                    if($row['entite_mere'] === 1){
                        $selected = ($rowId && $rowId["entite"] === $row["id_entite"]) ? 'selected' : '';
                        echo '<option value="' . $row['id_entite'] . '" ' . $selected .' ><b>' . $row['nom_entite'] . '</b></option>';
                    }
                    else{
                        $selected = ($rowId && $rowId["entite"] === $row["id_entite"]) ? 'selected' : '';
                        $sqlchild = "SELECT * FROM entite WHERE id_entite = ?";
                        $resultchild = $this->connect()->prepare($sqlchild);
                        $resultchild->execute(array($row["entite_mere"]));
                        $rowchild = $resultchild->fetch();
                        echo '<option value="' . $row['id_entite'] . '" ' . $selected .'>' . ucwords($row['nom_entite']) . '(' .  ucwords($rowchild['nom_entite']) . ')' . '</option>';
                    }
                }
                echo '</select>';
            }
        }
    protected function Puce(){
        $sql = "SELECT * FROM puce";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        echo '<label for="puce"><span style="color:red">*</span>Puce:</label>
                <select id="puce" name="puce" required>';
        if($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                echo '<option value="' . $row['id_puce'] . '"><b>' . $row['code'] . '</b></option>';
            }
        }
        echo '</select>';
    }
    protected function PuceById($id){
        $sql = "SELECT * FROM puce";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $sqlById = "SELECT * FROM dotation WHERE id_dotation=?";
        $stmtById = $this->connect()->prepare($sqlById);
        $stmtById->execute([$id]);
        if($stmtById->rowCount() > 0){
            $rowId = $stmtById->fetch();
        }
        echo '<label for="puce"><span style="color:red">*</span>Puce:</label>
                <select id="puce" name="puce" required>';
        if($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                $selected = ($rowId && $rowId["puce"] === $row["id_puce"]) ? 'selected' : '';
                echo '<option value="' . $row['id_puce'] . '" ' . $selected . '><b>' . $row['code'] . '</b></option>';
            }
        }
        echo '</select>';
    }
    protected function PuceByAffId($id) {
        $sql = "SELECT * FROM puce";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
        $sqlById = "SELECT * FROM assoc_pers WHERE puce=?";
        $stmtById = $this->connect()->prepare($sqlById);
        $stmtById->execute([$id]);
        
        $rowId = null;
        if ($stmtById->rowCount() > 0) {
            $rowId = $stmtById->fetch();
        }
        
        echo '<label for="puce"><span style="color:red">*</span>Puce:</label>
                <select id="puce" name="puce_display" disabled required>';
        
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $selected = ($rowId && $rowId["puce"] === $row["id_puce"]) ? 'selected' : '';
                echo '<option value="' . $row['id_puce'] . '" ' . $selected . '><b>' . $row['code'] . '</b></option>';
            }
        }
        
        echo '</select>';
        
        if ($rowId) {
            echo '<input type="hidden" name="puce" value="' . $rowId["puce"] . '">';
        }
    }
    
    protected function Matricule(){
        $sql = "SELECT * FROM personnel";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        echo '<label for="personnel"><span style="color:red">*</span>Personnel:</label>
                <select id="personnel" class="modpersonnel" name="personnel" required>';
        if($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                echo '<option value="' . $row['id_personnel'] . '"><b>' . $row['matricule'] . '</b></option>';
            }
        }
        echo '</select>';
    }
    protected function MatriculeById($id){
        $sql = "SELECT * FROM personnel";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $sqlById = "SELECT * FROM assoc_pers where puce=?";
        $stmtById = $this->connect()->prepare($sqlById);
        $stmtById->execute([$id]);
        if($stmtById->rowCount() > 0){
            $rowId = $stmtById->fetch();
        }
        echo '<label for="personnel"><span style="color:red">*</span>Personnel:</label>
                <select id="personnel" class="modpersonnel" name="personnel" required>';
        if($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                $selected = ($rowId && $rowId["personnel"] === $row["id_personnel"]) ? 'selected' : '';
                echo '<option value="' . $row['id_personnel'] . '" ' . $selected . '><b>' . $row['matricule'] . '</b></option>';
            }
        }
        echo '</select>';
    }
    protected function Persona(){
        $sql = "SELECT * FROM personnel";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        echo '<label for="fullName"><span style="color:red">*</span>Nom Et Prenom:</label>
                <select id="fullName" class="modfullName" name="fullName" required>';
        if($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                echo '<option value="' . $row['id_personnel'] . '"><b>' . ucwords($row['prenom']) . ' ' . ucwords($row['nom']) . '</b></option>';
            }
        }
        echo '</select>';
    }
    protected function PersonaById($id){
        $sql = "SELECT * FROM personnel";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $sqlById = "SELECT * FROM assoc_pers where puce=?";
        $stmtById = $this->connect()->prepare($sqlById);
        $stmtById->execute([$id]);
        if($stmtById->rowCount() > 0){
            $rowId = $stmtById->fetch();
        }
        echo '<label for="fullName"><span style="color:red">*</span>Nom Et Prenom:</label>
                <select id="fullName" class="modfullName" name="fullName" required>';
        if($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                $selected = ($rowId && $rowId["personnel"] === $row["id_personnel"]) ? 'selected' : '';
                echo '<option value="' . $row['id_personnel'] . '" ' . $selected . '><b>' . ucwords($row['prenom']) . ' ' . ucwords($row['nom']) . '</b></option>';
            }
        }
        echo '</select>';
    }
    protected function PersonnelData() {
        $sql = "SELECT * FROM personnel";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $data = [];
        if($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $data[] = [
                    'matricule' => $row['matricule'],
                    'name' => ucwords($row['prenom']) . ' ' . ucwords($row['nom'])
                ];
            }
        }
        echo '<script>const personnelData = ' . json_encode($data) . ';</script>';
    }
    protected function checkingUser($id){
        $sql = "SELECT * FROM user WHERE id_login = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            if($row["profil"] === "admin" || $row["profil"] === "operateur"){
                echo "
                <span class='buttonDiff chBg' onclick=\"openPopup('createPopup')\">Create</span>
                <button class='buttonDiff chBg' id='modifyButton' name='modify' onclick=\"openPopup('modifyPopup')\">Modify</button>
                <button class='buttonDiff chBg delete' name='delete'>Delete</button>
                ";
            }
            else if($row["profil"] === "observateur"){
                echo "
                <span class='disableButton chBg' disabled>Create</span>
                <button class='disableButton chBg' id='modifyButton' name='modify' disabled>Modify</button>
                <button class='disableButton chBg delete' name='delete' disabled>Delete</button>
                ";
            }
        }
    }
    protected function checkingUserException($id){
        $sql = "SELECT * FROM user WHERE id_login = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            if($row["profil"] === "admin"){
                echo "
                <span class='buttonDiff chBg' onclick=\"openPopup('createPopup')\">Create</span>
                <button class='buttonDiff chBg' id='modifyButton' name='modify' onclick=\"openPopup('modifyPopup')\">Modify</button>
                <button class='buttonDiff chBg delete' name='delete'>Delete</button>
                ";
            }
            else if($row["profil"] === "operateur" || $row["profil"] === "observateur"){
                echo "
                <span class='disableButton chBg' disabled>Create</span>
                <button class='disableButton chBg' id='modifyButton' name='modify' disabled>Modify</button>
                <button class='disableButton chBg delete' name='delete' disabled>Delete</button>
                ";
            }
        }
    }
    protected function tHeader($id){
        $sql = "SELECT * FROM user WHERE id_login = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            if($row["profil"] === "admin"){
                echo "
                <th><input type=\"checkbox\" id=\"selectAllCheckbox\"></th>
                <th onclick=\"sortTableHeader(1)\">Id<span id=\"arrow1\" class=\"inactive-arrow\"></span></th>
                <th onclick=\"sortTableHeader(2)\">Nom Utilisateur<span id=\"arrow2\" class=\"inactive-arrow\"></span></th>
                <th onclick=\"sortTableHeader(3)\">Mot De Passe<span id=\"arrow3\" class=\"inactive-arrow\"></span></th>
                <th onclick=\"sortTableHeader(4)\">Profil<span id=\"arrow4\" class=\"inactive-arrow\"></span></th>
                <th onclick=\"sortTableHeader(5)\">Observation<span id=\"arrow5\" class=\"inactive-arrow\"></span></th>
                <th>View More</th>
                ";
            }
            else if($row["profil"] === "operateur" || $row["profil"] === "observateur"){
                echo "
                <th><input type=\"checkbox\" id=\"selectAllCheckbox\"></th>
                <th onclick=\"sortTableHeader(1)\">Nom Utilisateur<span id=\"arrow1\" class=\"inactive-arrow\"></span></th>
                <th onclick=\"sortTableHeader(2)\">Profil<span id=\"arrow2\" class=\"inactive-arrow\"></span></th>
                <th onclick=\"sortTableHeader(3)\">Observation<span id=\"arrow3\" class=\"inactive-arrow\"></span></th>
                <th>View More</th>
                ";
            }
        }
    }
    protected function orderBy($id){
        $sql = "SELECT * FROM user WHERE id_login = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            if($row["profil"] === "admin"){
                echo "
                <select id=\"order-by\" name=\"order-by\" required>
                    <option></option>  
                    <option value=\"1\">Id</option>
                    <option value=\"2\">Nom Utilisateur</option>
                    <option value=\"3\">Mot De Passe</option>
                    <option value=\"4\">Profil</option>
                    <option value=\"5\">Observation</option>
                </select> 
                ";
            }
            else if($row["profil"] === "operateur" || $row["profil"] === "observateur"){
                echo "
                <select id=\"order-by\" name=\"order-by\" required>
                    <option></option>
                    <option value=\"1\">Nom Utilisateur</option>
                    <option value=\"2\">Profil</option>
                    <option value=\"3\">Observation</option>
                </select> 
                ";
            }
        }
    }
}
?>