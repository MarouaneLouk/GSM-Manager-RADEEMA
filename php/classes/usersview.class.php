<?php
    Class UsersView extends UsersContr {
        public function showUserTable($id){
            $nbrowtab = $this -> getUserTable($id);
            return $nbrowtab;
        }
        public function showEntiteTable(){
            $nbrowtab = $this -> getEntiteTable();
            return $nbrowtab;
        }
        public function getModifyContentEntiteName($idEntity){
            $nbrowtab = $this -> getModifyContentEntite($idEntity);
            return $nbrowtab['nom_entite'];
        }
        public function getModifyContentEntiteType($idEntity){
            $nbrowtab = $this -> getModifyContentEntite($idEntity);
            return $nbrowtab['type_entite'];
        }


        public function getModifyContentPersName($idPers){
            $nbrowtab = $this -> getModifyContentPers($idPers);
            return $nbrowtab['nom'];
        }
        public function getModifyContentPersSurname($idPers){
            $nbrowtab = $this -> getModifyContentPers($idPers);
            return $nbrowtab['prenom'];
        }
        public function getModifyContentPersMatricule($idPers){
            $nbrowtab = $this -> getModifyContentPers($idPers);
            return $nbrowtab['matricule'];
        }
        public function getModifyContentPersStatus($idPers){
            $nbrowtab = $this -> getModifyContentPers($idPers);
            return $nbrowtab['user_status'];
        }
        public function getModifyContentPersEntite($idPers){
            $nbrowtab = $this -> getModifyContentPers($idPers);
            return $nbrowtab['entite'];
        }
        public function getModifyContentPersObservation($idPers){
            $nbrowtab = $this -> getModifyContentPers($idPers);
            return $nbrowtab['observation'];
        }

        public function getModifyContentPuceNumero($idPuce){
            $nbrowtab = $this -> getModifyContentPuce($idPuce);
            return $nbrowtab['numero'];
        }
        public function getModifyContentPuceCode($idPuce){
            $nbrowtab = $this -> getModifyContentPuce($idPuce);
            return $nbrowtab['code'];
        }
        public function getModifyContentPuceType($idPuce){
            $nbrowtab = $this -> getModifyContentPuce($idPuce);
            return $nbrowtab['type_puce'];
        }
        public function getModifyContentPuceObservation($idPuce){
            $nbrowtab = $this -> getModifyContentPuce($idPuce);
            return $nbrowtab['observation'];
        }

        public function getModifyContentUserNom($idUser){
            $nbrowtab = $this -> getModifyContentUser($idUser);
            return $nbrowtab['nom_utilisateur'];
        }
        public function getModifyContentUserPrenom($idUser){
            $nbrowtab = $this -> getModifyContentUser($idUser);
            return $nbrowtab['prenom_utilisateur'];
        }
        public function getModifyContentUserPassword($idUser){
            $nbrowtab = $this -> getModifyContentUser($idUser);
            return $nbrowtab['mot_passe'];
        }
        public function getModifyContentUserProfil($idUser){
            $nbrowtab = $this -> getModifyContentUser($idUser);
            return $nbrowtab['profil'];
        }
        public function getModifyContentUserObservation($idUser){
            $nbrowtab = $this -> getModifyContentUser($idUser);
            return $nbrowtab['observation'];
        }


        public function getModifyContentDotationPuce($idDotation){
            $nbrowtab = $this -> getModifyContentDotation($idDotation);
            return $nbrowtab['puce'];
        }
        public function getModifyContentDotationSolde($idDotation){
            $nbrowtab = $this -> getModifyContentDotation($idDotation);
            return $nbrowtab['solde'];
        }
        public function getModifyContentDotationDate($idDotation){
            $nbrowtab = $this -> getModifyContentDotation($idDotation);
            return $nbrowtab['date_dotation'];
        }
        public function getModifyContentDotationObservation($idDotation){
            $nbrowtab = $this -> getModifyContentDotation($idDotation);
            return $nbrowtab['observation'];
        }
        

        public function getModifyContentAffPersonnelByIdPuce($idAff){
            $nbrowtab = $this -> getModifyContentAffByIdPuce($idAff);
            return $nbrowtab['code'];
        }
        
        public function getModifyContentAffPersonnelByIdPers($idAff){
            $nbrowtab = $this -> getModifyContentAffByIdPers($idAff);
            return $nbrowtab['matricule'];
        }
        public function getModifyContentAffFullNameByIdPers($idAff){
            $nbrowtab = $this -> getModifyContentAffByIdPers($idAff);
            return $nbrowtab['prenom'] . ' ' . $nbrowtab['nom'];
        }
        public function getModifyContentAffDateAff($idAff){
            $nbrowtab = $this -> getModifyContentAff($idAff);
            return $nbrowtab['date_affectation'];
        }
        public function getModifyContentAffDateDesaff($idAff){
            $nbrowtab = $this -> getModifyContentAff($idAff);
            return $nbrowtab['date_desaffectation'];
        }


        public function showPuceTable(){
            $nbrowtab = $this -> getPuceTable();
            return $nbrowtab;
        }
        public function showAffpuceTable(){
            $nbrowtab = $this -> getAffpuceTable();
            return $nbrowtab;
        }
        public function showReportTable(){
            $nbrowtab = $this -> getReportTable();
            return $nbrowtab;
        }
        public function showDotationTable(){
            $nbrowtab = $this -> getDotationTable();
            return $nbrowtab;
        }
        public function showPersonnelTable(){
            $nbrowtab = $this -> getPersonnelTable();
            return $nbrowtab;
        }
        public function getNameById($id){
            $result = $this -> getInfo($id);
            return $result['nom_utilisateur'];
        }
        public function getSurnameById($id){
            $result = $this -> getInfo($id);
            return $result['prenom_utilisateur'];
        }
        public function getPwdById($id){
            $result = $this -> getInfo($id);
            return $result['mot_passe'];
        }
        public function GetSelectEntiteMere(){
            $this -> SelectEntiteMere();
        }
        public function GetSelectEntiteMereById($id){
            $this -> SelectEntiteMereById($id);
        }
        public function GetSelectEntite(){
            $this -> SelectEntite();
        }
        public function GetSelectEntiteById($id){
            $this -> SelectEntiteById($id);
        }
        public function GetSelectPuce(){
            $this -> SelectPuce();
        }
        public function GetSelectPuceById($id){
            $this -> SelectPuceById($id);
        }
        public function GetSelectPuceByAffId($id){
            $this -> SelectPuceByAffId($id);
        }
        public function GetSelectMatricule(){
            $this -> SelectMatricule();
        }
        public function GetSelectMatriculeById($id){
            $this -> SelectMatriculeById($id);
        }
        public function GetSelectPersona(){
            $this -> SelectPersona();
        }
        public function GetSelectPersonaById($id){
            $this -> SelectPersonaById($id);
        }
        public function personnelInfo(){
            $this -> GetPersonnelData();
        }
        public function viewtHeaderContent($id){
            $this -> tHeaderContent($id);
        }
        public function showorderBySelector($id){
            $this -> orderBySelector($id);
        }
    }
    
?>