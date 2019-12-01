 <div class="card-body">
        <!--                            Form für Filter...-->
        <form action="Produkte.php" method="get">
            <h5 class="card-title">Speisenliste filtern</h5>
            <div class="form-group">
                <select class="form-contro align-items-center" id="kategorien">
                    <?php
                    if ($kateresult) {// Query ausführen..
                        $optgrouprow = mysqli_fetch_all($kateresult); //$optgroup index 0 -> ID 1-> Kategorie_ID 2 -> BILD ID 3 -> Bezeichnung
                        //same for $option
                        foreach($optgrouprow as $optgroup) {
                            if($optgroup[1] == NULL )//Ab in ein OPTGroup
                                echo '<optgroup label="'. $optgroup[3] .'">';
                            foreach($optgrouprow as $option) {//Suche alle die zu der OPTGroup gehören...
                                if($optgroup[0] == $option[1]){//$optgroup -> Obergruppe $option -> Subgruppen
                                    echo '<option value="'. $option[3] .'">'. $option[3] .'</option>';
                                }
                            }
                            echo '</optgroup>';//Wenn alle unterkategorien gefunden wurden..
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-check">
                <ul style="list-style: none">
                    <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">nur verfügbare</label></li>
                    <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                        <label class="form-check-label" for="defaultCheck2">nur vegetarische</label></li>
                    <li><input class="form-check-input" type="checkbox" value="" id="defaultCheck3">
                        <label class="form-check-label" for="defaultCheck3">nur vegane</label></li>
                </ul>
            </div>
            <a href="#" class="btn btn-dark" id="filter">Speisen filtern</a>
        </form>
    </div>
