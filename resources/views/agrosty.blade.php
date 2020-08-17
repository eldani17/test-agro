<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Mensaje Contacto</h5>
            <div>
              <div class="form-group">
                <label for="fromName">Nombre</label>
                <input type="text" class="form-control" id="fromName" placeholder="Ingrese su nombre">
                </div>
              <div class="form-group">
                <label for="fromEmail">Email</label>
                <input type="email" class="form-control" id="fromEmail" placeholder="Ingrese su email">
              </div>
              <div class="form-group">
                <label for="subjectId">Asunto</label>
                <select class="form-control" id="subjectId" class="text-capitalize">
                </select>
              </div>
              <div class="form-group">
                <label for="body">Mensaje</label>
                <textarea class="form-control" id="body" rows="3" placeholder="Ingrese su mensaje"></textarea>
              </div>

              <button class="btn btn-primary" id="send">Enviar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<body>

<script>
  var select_subject = document.getElementById('subjectId');
  var btn_message = document.getElementById('send');

  const getSubjects = () => {
    axios.get(`http://127.0.0.1/agrosty/public/api/subject`, {responseType: 'json'}).then(function(resp) {
      if (resp.status === 200){
        const subjects = resp.data.subjects;
        let options = '';
        for (let i=0; i< subjects.length; i++){
          let option = '';
          option += `<option value="${subjects[i].id}" class="text-capitalize">${subjects[i].desc}</option>`;
          options += option;
        }
        select_subject.innerHTML = options;
      }
    });
  }

  const sendMessage = (info) => {
    var data = JSON.stringify(info);
    return axios.post(`http://127.0.0.1/agrosty/public/api/message`, { json: data});
  }

  const getMessages = () => {
    axios.get(`http://127.0.0.1/agrosty/public/api/message`, {responseType: 'json'}).then(function(resp) {
      if (resp.status === 200){
        const messages = resp.data.messages;
        console.log("messages api", messages);
      }
    });
  }

  getSubjects();
  getMessages();

  btn_message.addEventListener('click', function(){
    let subjectId_select = document.getElementById('subjectId');
    let fromName_input = document.getElementById('fromName');
    let fromEmail_input = document.getElementById('fromEmail');
    let body_textarea = document.getElementById('body');

    let info = {
      'subjectId': subjectId_select.value,
      'fromName': fromName_input.value,
      'fromEmail': fromEmail_input.value,
      'body': body_textarea.value,
    }

    sendMessage(info).then(function(resp){
      if (resp.status === 200){
        //mostrar los mensajes enviados
        //getMessages();
      }
    });
  });
</script>
</body>
</html>
