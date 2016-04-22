<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>NBG Open Bank API HTML/JavaScript</title>
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="bower_components/codemirror/lib/codemirror.css" />
        <link rel="stylesheet" href="bower_components/codemirror/theme/mdn-like.css" />
    </head>
    <body>
        <div class="container">
            <h1>PHP client for the NBG Open Bank API</h1>
            <form>
                <div class="form-group">
                    <label for="request-path">Subscription secondary key</label>
                    <input name="secondary-key" type="text" class="form-control" id="secondary-key" placeholder="e.g. hjklqwe">
                </div>
                <div class="form-group">
                    <label for="request-method">Request Method</label>
                    <select name="request-method" id="request-method" class="form-control">
                        <option value="get">GET</option>
                        <option value="post">POST</option>
                        <option value="put">PUT</option>
                        <option value="delete">DELETE</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="request-path">Path</label>
                    <input name="request-path" type="text" class="form-control" id="request-path" placeholder="e.g. /api/banks/rest">
                </div>
                <div class="form-group">
                    <label for="request-body">Request parameters or body (JSON)</label>
                    <textarea name="request-body"  id="request-body" class="form-control" >{}</textarea>
                </div>
                <button id="submit-request" type="button" class="btn btn-default">Submit request</button>
            </form>

            <h2>Response</h2>
            <pre id="response"></pre>
        </div>

        <script src="bower_components/fetch/fetch.js" ></script>
        <script src="bower_components/codemirror/lib/codemirror.js" ></script>
        <script src="bower_components/codemirror/mode/javascript/javascript.js" ></script>
        <script>
            var editor = CodeMirror.fromTextArea(document.getElementById('request-body'), {
                    theme: 'mdn-like',
                    mode: 'application/json',
                    matchBrackets: true,
                    continueComments: "Enter",
                }),
                secondaryKey = document.getElementById('secondary-key'),
                submitRequest = document.getElementById('submit-request'),
                responseDiv = document.getElementById('response');
            if (localStorage.getItem('secondary-key')) {
                secondaryKey.value = localStorage.getItem('secondary-key');
            }
            secondaryKey.onkeyup = function () {
                localStorage.setItem('secondary-key', secondaryKey.value);
            }
            submitRequest.onclick = function () {
                fetch('request.php', {
                    method: 'POST',
                    body: new FormData(document.querySelector('form'))
                }).then(function (response) {
                    submitRequest.value = 'Submit request';
                    submitRequest.disabled = false;
                    response.text().then(function (text) {
                        responseDiv.textContent = text;
                    });
                })
            };
        </script>
    </body>
</html>
