<!-- Corpo -->
    <div class="container">
      <h2>Formulário para Contato</h2>
      <form role="form" action="/enviar" method="post">
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input type="text" class="form-control" placeholder="Campo para Nome" name="nome" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" placeholder="Entre com o email" name="email" required>
        </div>
        <div class="form-group">
          <label for="assunto">Assunto:</label>
          <input type="text" class="form-control" placeholder="Campo para Assunto" name="assunto" required>
        </div>
        <div class="form-group">
          <label for="mensagem">Mensagem:</label>
          <textarea class="form-control" rows="5" name="mensagem" required></textarea>
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
