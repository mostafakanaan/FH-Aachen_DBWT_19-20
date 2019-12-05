@extends('app')
@section('pageTitle','Produkte')
@section('content')
     <div class="row">
            <div class="col-3">
                <div class="card background" id="bigcard">
                    @include('Filter',['kateresult' => $kateresult])
                </div>
            </div>
            <div class="col-9">
                <div class="row background" id="titel">
                    <h2>Verfügbare Speisen (Bestseller)</h2>
                </div>

                <div class="row">
                    <?php
                    if ($result) {// Query ausführen..
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
                    ?>
                </div>
            </div>
        </div>
@endsection