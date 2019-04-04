<div class="modal fade" id="inscriptionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{route('inscription.store')}}" method="POST">
    {{ csrf_field() }}
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Demande d'inscription</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
                <div class="form-group">
                    <label for="message">(Facultatif) Message à l'organisateur</label>
                    <textarea  class="form-control" name="message"></textarea>
                    <input type="number" name="workshop_id" value="{{$workshop->id}}" hidden>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
        </div>
    </form>
  </div>
</div>