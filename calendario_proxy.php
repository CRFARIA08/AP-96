<?php
$origem = 'https://script.google.com/macros/s/AKfycbxd-IH43mCezB3n2JG7TSRDLgT0Imrmb5ijPE63CxubOUkrVEd-sFffxVp-Icubz9-R/exec?formato=ics';

$contexto = stream_context_create([
  'http' => [
    'method' => 'GET',
    'timeout' => 20,
    'header' => "User-Agent: AP96-Calendar-Proxy\r\n"
  ]
]);

$conteudo = @file_get_contents($origem, false, $contexto);

if ($conteudo === false) {
  http_response_code(502);
  header('Content-Type: text/plain; charset=utf-8');
  echo 'Erro ao carregar o calendário do AP-96.';
  exit;
}

header('Content-Type: text/calendar; charset=utf-8');
header('Content-Disposition: inline; filename="calendario.ics"');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');

echo $conteudo;
