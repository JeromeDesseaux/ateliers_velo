@if(isset($workshop))
    {{ Form::model($workshop, ['route' => ['workshop.update', $workshop->slug], 'enctype' => 'multipart/form-data', 'method' => 'put']) }}
@else
    {{ Form::open(['route' => 'workshop.store', 'enctype' => 'multipart/form-data']) }}
@endif
    <div class="form-group">
        {{ Form::label('title', 'Titre') }}
        {{ Form::text('title', Input::old('title'), ['class' => 'form-control', 'required' => 'required']) }}
        @if ($errors->has('title'))
            <div class="invalid-feedback">{{ $errors->first('title') }}</div>
        @endif
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', Input::old('description'), ['class' => 'form-control '.($errors->has('description') ? "is-invalid":"")]) }}
        @if ($errors->has('description'))
            <div class="invalid-feedback">{{ $errors->first('description') }}</div>
        @endif
    </div>
    <div class="form-group">
        {{ Form::label('category_id', 'Catégorie') }}
        {{ Form::select('category_id', $categories, Input::old('category_id'), ['class' => 'form-control']) }}
    </div>
    <div class="form-group">
        {{ Form::label('image', 'Image d\'en-tête') }}
        {{ Form::file('image', Input::old('image'), ['class' => 'form-control']) }}
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label('zipcode', 'Code postal') }}
                {{ Form::number('zipcode', Input::old('zipcode'), ['class' => 'form-control', 'id' => 'zipcode']) }}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                {{ Form::label('city', 'Ville') }}
                <!-- {{ Form::text('city', Input::old('city'), ['class' => 'form-control', "disabled" => Input::old('city')==null]) }} -->
                <select name="city" id="city" class="form-control" {{ !isset($workshop) ? "disabled" : "" }}> 
                    @if(isset($workshop))
                        <option value="{{$workshop->city}}">{{$workshop->city}}</option>
                    @endif
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('place', '(Facultatif) Détails sur le lieu de rendez-vous') }}
        {{ Form::text('place', Input::old('place'), ['class' => 'form-control']) }}
    </div>
    <div class="form-check">
        <label class="form-check-label" for="defaultCheck1">
            {{-- <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" name="automatic_validation"> --}}
            {{Form::checkbox('automatic_validation', '1', Input::old('automatic_validation'),['class'=>'form-check-input','id'=>'defaultCheck1']) }}
            Valider automatiquement les inscriptions?
        </label>
    </div>

    <div style="position: relative">
        <div class="form-group">
            {{ Form::label('date', 'Date de la rencontre') }}
            {{ Form::text('date', Input::old('date'), ['class' => 'form-control datetimepicker-input', "id" => "datetimepicker", "data-toggle" => "datetimepicker", "data-target" => "#datetimepicker"]) }}
        </div>
    </div>
    
    {{ Form::text('latitude', Input::old('latitude'), ['id' => 'latitude', "hidden" => false]) }}
    {{ Form::text('longitude', Input::old('longitude'), ['id' => 'longitude', "hidden" => false]) }}

    {{ Form::submit('Valider', [ 'class' => 'btn btn-success']) }}

{{ Form::close() }}


<script>

$(function () {
    // Tempus Dominus date picker load remove class
    $('*[data-toggle="datetimepicker"]').removeClass('datetimepicker-input');

    // Add class back to Tempus Dominus date picker
    $(document).on('toggle change hide keydown keyup', '*[data-toggle="datetimepicker"]', function(){ 
        $(this).addClass('datetimepicker-input');
        // $(this).val(Input::old('date'));
    });
    
    $('#datetimepicker').datetimepicker({
        icons: {
            time: 'far fa-clock'
        },
        locale: "fr"
    });
});

updateLatLng = function(){
    console.log("test");
    city = cities.find(city => city.nom == $("#city").val());
    if(city){
        $('#latitude').val(city.centre.coordinates[1]);
        $('#longitude').val(city.centre.coordinates[0]);
    }
}

var cities = []

$('#zipcode').on('change paste keyup',function(){
    let zipcode = $('#zipcode').val();
    var selectCity = $("#city");
    selectCity.find("option").remove();    
    if(zipcode.length==5){
        let formattedURL = "https://geo.api.gouv.fr/communes?codePostal="+zipcode+"&fields=nom,centre&format=json&geometry=centre"
        $.ajax({
            url: formattedURL,
            dataType: 'json',
            success: function(data) {
                cities = data
                $.each(data, function() {
                    selectCity.append($("<option />").val(this.nom).text(this.nom));
                });
                selectCity.removeAttr("disabled");
                selectCity.trigger('change');
            }
        });
    }else{
        selectCity.prop("disabled", true);
        $('#latitude').val('');
        $('#longitude').val('');
    }
    
});

$("#city").on('change paste keyup',function(){
    updateLatLng();
});
</script>