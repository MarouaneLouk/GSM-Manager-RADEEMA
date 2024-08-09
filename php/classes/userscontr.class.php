<?php
    Class UsersContr extends Users{
        public function login($login,$pwd){
            $nbLignes = $this -> checkLogin($login,$pwd);
            if($nbLignes===1){
                $_SESSION["login_autorisation"]="yes";
                header("location: ../html/HomePage.php");
            }
            else{
                $_SESSION['ErrorLogin']="Login or Password incorrect!";
                header("location: ../html/index.php");
            }
        }
        protected function getInfo($id){
            $result = $this -> getInfoById($id);
            $User_Info =  $result->fetch();
            return $User_Info;
        }
        protected function getUserTable($id){
            $nbrowtab = $this -> userTable($id);
            return $nbrowtab;
        }
        protected function tHeaderContent($id){
            $this -> tHeader($id);
        }
        protected function orderBySelector($id){
            $this -> orderBy($id);
        }
        public function contrinsertUser($nomUser,$prenomUser,$motPasse,$profil,$observation){
            $this -> insertUser($nomUser,$prenomUser,$motPasse,$profil,$observation);
        }
        public function contrinsertDotation($puce,$solde,$dateDotation,$observation){
            $this -> insertDotation($puce,$solde,$dateDotation,$observation);
        }
        public function contrinsertPuce($numero,$code,$typePuce,$observation){
            $this -> insertPuce($numero,$code,$typePuce,$observation);
        }
        public function contrinsertEntite($nomEntite,$typeEntite,$entiteMere){
            $this -> insertEntite($nomEntite,$typeEntite,$entiteMere);
        }
        public function contrinsertPer($matricule,$userStatus,$nom,$prenom,$entite,$observation){
            $this -> insertPer($matricule,$userStatus,$nom,$prenom,$entite,$observation);
        }
        public function contrinsertAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation){
            $this -> insertAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation);
        }
        protected function getEntiteTable(){
            $nbrowtab = $this -> entiteTable();
            return $nbrowtab;
        }
        protected function getPuceTable(){
            $nbrowtab = $this -> puceTable();
            return $nbrowtab;
        }
        protected function getAffpuceTable(){
            $nbrowtab = $this -> affpuceTable();
            return $nbrowtab;
        }
        protected function getReportTable(){
            $nbrowtab = $this -> ReportTable();
            return $nbrowtab;
        }
        protected function getDotationTable(){
            $nbrowtab = $this -> dotationTable();
            return $nbrowtab;
        }
        protected function getPersonnelTable(){
            $nbrowtab = $this -> personnelTable();
            return $nbrowtab;
        }
        public function contrDeleteEntite($extract_id){
            $this -> deleteEntite($extract_id);
        }
        public function contrDeletePers($extract_id){
            $this -> deletePers($extract_id);
        }
        public function contrDeletePuce($extract_id){
            $this -> deletePuce($extract_id);
        }
        public function contrDeleteAffpuce($extract_id){
            $this -> deleteAffpuce($extract_id);
        }
        public function contrDeleteDotation($extract_id){
            $this -> deleteDotation($extract_id);
        }
        public function contrDeleteUser($extract_id){
            $this -> deleteUser($extract_id);
        }

        


        public function contrModifyEntite($nomEntite,$typeEntite,$entiteMere,$extract_id){
            $this -> modifyEntite($nomEntite,$typeEntite,$entiteMere,$extract_id);
        }
        public function contrModifyPers($matricule,$user_status,$nom,$prenom,$entite,$observation,$extract_id){
            $this -> modifyPers($matricule,$user_status,$nom,$prenom,$entite,$observation,$extract_id);
        }
        public function contrModifyPuce($numero,$code,$typePuce,$observation,$extract_id){
            $this -> modifyPuce($numero,$code,$typePuce,$observation,$extract_id);
        }
        public function contrModifyUser($nomUser,$prenomUser,$motPasse,$profil,$observation,$extract_id){
            $this -> modifyUser($nomUser,$prenomUser,$motPasse,$profil,$observation,$extract_id);
        }
        public function contrModifyDotation($puce,$solde,$dateDotation,$observation,$extract_id){
            $this -> modifyDotation($puce,$solde,$dateDotation,$observation,$extract_id);
        }
        public function contrModifyAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation,$extract_id){
            $this -> modifyAffpuce($puce,$personnel,$fullName,$dateAffectation,$dateDesaffectation,$extract_id);
        }




        protected function getModifyContentEntite($idEntity){
            $nbrowtab = $this -> ModifyContentEntite($idEntity);
            return $nbrowtab;
        }
        protected function getModifyContentPers($idPers){
            $nbrowtab = $this -> ModifyContentPers($idPers);
            return $nbrowtab;
        }
        protected function getModifyContentPuce($idPuce){
            $nbrowtab = $this -> ModifyContentPuce($idPuce);
            return $nbrowtab;
        }
        protected function getModifyContentUser($idUser){
            $nbrowtab = $this -> ModifyContentUser($idUser);
            return $nbrowtab;
        }
        protected function getModifyContentDotation($idDotation){
            $nbrowtab = $this -> ModifyContentDotation($idDotation);
            return $nbrowtab;
        }
        protected function getModifyContentAff($idAff){
            $nbrowtab = $this -> ModifyContentAff($idAff);
            return $nbrowtab;
        }
        protected function getModifyContentAffByIdPers($idAff){
            $nbrowtab = $this -> ModifyContentAffByIdPers($idAff);
            return $nbrowtab;
        }
        protected function getModifyContentAffByIdPuce($idAff){
            $nbrowtab = $this -> ModifyContentAffByIdPuce($idAff);
            return $nbrowtab;
        }






        public function ModifyPwd($newPwd,$id){
            $this -> ModifyUserPwd($newPwd,$id);
        }
        protected function SelectEntiteMere(){
            $this -> EntiteMere();
        }
        protected function SelectEntiteMereById($id){
            $this -> EntiteMereById($id);
        }
        protected function SelectEntite(){
            $this -> Entite();
        }
        protected function SelectEntiteById($id){
            $this -> EntiteById($id);
        }
        protected function SelectPuce(){
            $this -> Puce();
        }
        protected function SelectPuceById($id){
            $this -> PuceById($id);
        }
        protected function SelectPuceByAffId($id){
            $this -> PuceByAffId($id);
        }
        protected function SelectMatricule(){
            $this -> Matricule();
        }
        protected function SelectMatriculeById($id){
            $this -> MatriculeById($id);
        }
        protected function SelectPersona(){
            $this -> Persona();
        }
        protected function SelectPersonaById($id){
            $this -> PersonaById($id);
        }
        protected function GetPersonnelData(){
            $this -> PersonnelData();
        }
        public function checkUserById($id){
            $this -> checkingUser($id);
        }
        public function checkUserByIdException($id){
            $this -> checkingUserException($id);
        }
    }
?>