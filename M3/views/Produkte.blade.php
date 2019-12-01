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
                        while ($row = mysqli_fetch_assoc($result) and $limit > 0) {
                            $id = $row['id']; //ID richtig setzen.. -> bessere lösung: alles in ein Array wie bei Detail.php
                            if($row['Verfuegbar']) {// Wenn Produkt verfügbar ist..
                                echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row["Binaerdaten"]).'" alt="'. $row['Alt-Text']. '" class="smallimg">
                        <p class="produkt">' . $row['Name'] . '</p>
                        <a href="Detail.php?id=' . $id . '" class="underline">Details</a>
                        </div>';
                            }else if(!($row['Verfuegbar']) ){//Wenn Produkt vergriffen ist...
                                if($available == "false"){
                                    echo '<div class="col-3 cols"><img src="data:image/gif;base64,'.base64_encode($row['Binaerdaten']).'" alt="'.$row['Alt-Text'].'" class="smallimg">
                        <p class="grauerText produkt">' . $row['Name'] . '</p>
                        <a  class="grauerText">vergriffen</a>
                        </div>';
                                }
                            }
                            $limit--;
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
@endsection