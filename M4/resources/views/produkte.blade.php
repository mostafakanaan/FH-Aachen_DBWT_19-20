@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="card background" id="bigcard">
                <div class="card-body">
                    <!--                            Form für Filter...-->
                    <form action="Produkte.php" method="GET">
                        <h5 class="card-title">Speisenliste filtern</h5>
                        <div class="form-group">
                            <select class="form-contro align-items-center" name="kat" id="kategorien">
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
                <h2></h2>
            </div>

            <div class="row">
            </div>
        </div>
    </div>
@endsection
