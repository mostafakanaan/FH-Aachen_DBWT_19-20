@extends('app')
@section('pageTitle','Produkte')
@section('content')
    <div class="row">
        <div class="col-3">
            <div class="card background" id="bigcard">
                <?php

                $katedesc = array();
                $bestseller ="";
                $optgrouprow = mysqli_fetch_all($kateresult);

                ?>
                <div class="card-body">
                    <!--                            Form für Filter...-->
                    <form action="Produkte.php" method="GET">
                        <h5 class="card-title">Speisenliste filtern</h5>
                        <div class="form-group">
                            <select class="form-contro align-items-center" name="kat" id="kategorien">
                                <?php
                                if ($kateresult) {// Query ausführen..
                                    //$optgroup index 0 -> ID 1-> Kategorie_ID 2 -> BILD ID 3 -> Bezeichnung
                                    //same for $option
                                    foreach($optgrouprow as $optgroup) {
                                        if($optgroup[1] == NULL )//Ab in ein OPTGroup
                                            echo '<optgroup label="'. $optgroup[3] .'">';
                                        foreach($optgrouprow as $option) {//Suche alle die zu der OPTGroup gehören...
                                            if($optgroup[0] == $option[1]){//$optgroup -> Obergruppe $option -> Subgruppen
                                                echo '<option value="'.  $option[0] .'" name="kat"  >' . $option[3] . '</option>';
                                                $katedesc[$option[0]] = $option[3];
                                            }
                                        }
                                        echo '</optgroup>';//Wenn alle unterkategorien gefunden wurden..
                                    }
                                }
                                ($kat != 2 ? $bestseller = $katedesc[$_GET['kat']] :  $bestseller = 'Bestseller');

                                ?>
                            </select>
                        </div>
                        <div class="form-check">
                            <ul style="list-style: none">
                                <li>
                                    <input class="form-check-input" type="checkbox"  name="avail" value="1" id="available">
                                    <label class="form-check-label" for="defaultCheck1">nur verfügbare</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="checkbox" name="vegetarisch" value="1" id="vegetarian">
                                    <label class="form-check-label" for="defaultCheck2">nur vegetarische</label>
                                </li>
                                <li>
                                    <input class="form-check-input" type="checkbox" name="vegan" value="1" id="vegan">
                                    <label class="form-check-label" for="defaultCheck3">nur vegane</label>
                                </li>
                            </ul>
                        </div>
                        <button class="btn btn-dark" id="filter" type="submit">Speisen filtern</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="row background" id="titel">
                <h2><?php echo 'Verfügbare Speisen ('  . $bestseller  . ') '?></h2>
            </div>

            <div class="row">
                @php if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id']; //ID richtig setzen.. -> bessere lösung: alles in ein Array wie bei DetailController.php
                            if($row['Verfuegbar'] == '1') {// Wenn Produkt verfügbar ist..
                                echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row["Binaerdaten"]).'" alt="'. $row['Alt-Text']. '" class="smallimg">
                        <p class="produkt">' . $row['Name'] . '</p>
                        <a href="Detail.php?id=' . $id . '" class="underline">Details</a>
                        </div>';
                            }else if($row['Verfuegbar'] == '0') {//Wenn Produkt vergriffen ist...
                                    echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row['Binaerdaten']).'" alt="'.$row['Alt-Text'].'" class="smallimg">
                        <p class="grauerText produkt">' . $row['Name'] . '</p>
                        <a  class="grauerText">vergriffen</a>
                        </div>';
                            }
                        }
                    }
                @endphp
            </div>
        </div>
    </div>
@endsection