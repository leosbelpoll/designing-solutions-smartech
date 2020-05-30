<div class="container bg-white">
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-4">
            <div class="alert alert-info" role="alert">
                <strong>Atención</strong> Recuerde que esta operación le enviará un mensaje a todos sus usuarios
            </div>
            <form method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="title">Título</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="titleHelp">
                    <small id="titleHelp" class="form-text text-muted">Título de la notificación.</small>
                </div>
                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea class="form-control" id="message" name="message" aria-describedby="messageHelp"></textarea>
                    <small id="messageHelp" class="form-text text-muted">Mensaje de la notificación.</small>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
        <div class="col-xs-4"></div>
    </div>
</div>