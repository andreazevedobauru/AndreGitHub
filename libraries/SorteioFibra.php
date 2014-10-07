<?php



##########################################
//    Faz o sorteio da sequencia
//
##########################################

class SorteioFibra extends \BaseController
{
    public static function sortear($campeonato, $evento, $tipo_ave, $prova, $cpf, $id_prova){
    
        $resultado = EventoMapa::join('prova', 'prova.id', '=', 'evento_mapa.id_prova')
                                ->join('tipo_ave', 'tipo_ave.id', '=', 'prova.tipo_ave')
                                ->whereId_evento($evento)
                                ->where('tipo_ave.tipo', '=',$tipo_ave)
                                ->where('prova.tipo', '=', $prova)
                                ->where('prova.id', '=', $id_prova)
                                ->get();
        

        $inscricoes = count($resultado);
        $ocupados = array();

        for($i = 0; $i < $inscricoes; $i++){
            // preenche um vetor com as posicoes ocupadas
            $ocupados[] = $resultado[$i]['sequencia'];
        }

        asort($ocupados);

        //Se o campeonato for COBRAP aumenta o intervalo do sorteio
        if($campeonato == 8) {
            if($tipo_ave == 'B') { // BICUDO
                $posicoes = $inscricoes > 280 ? $posicoes = range(1, $inscricoes + 20) : $posicoes = range(1, 300);
            } elseif($tipo_ave == 'CO') { // COLEIRINHO
                $posicoes = $inscricoes > 160 ? $posicoes = range(1, $inscricoes + 20) : $posicoes = range(1, 180);
            } elseif($tipo_ave == 'TRI') { // TRINCA-FERRO
                $posicoes = $inscricoes > 100 ? $posicoes = range(1, $inscricoes + 20) : $posicoes = range(1, 120);
            } elseif($tipo_ave == 'C') { // CURIO
                $posicoes = $inscricoes > 80  ? $posicoes = range(1, $inscricoes + 20) : $posicoes = range(1, 100);
            } elseif($tipo_ave == 'CA') { // CANARIO DA TERRA
                $posicoes = $inscricoes > 65  ? $posicoes = range(1, $inscricoes + 20) : $posicoes = range(1, 80);
            } else {
                $posicoes = $inscricoes > 35  ? $posicoes = range(1, $inscricoes + 20) : $posicoes = range(1, 50);
            }
        } else {
            $posicoes = $inscricoes > 35 ? $posicoes = range(1, $inscricoes + 20) : $posicoes = range(1, 50);
        }

        // faz a diferenca entre os vetores de posicao e ocupados
        $disponiveis = array_diff($posicoes, $ocupados);
        shuffle($disponiveis);

        do{
            // é somado 1 no retorno para pegar o valor e nao a chave
            if(count($disponiveis) > 0) {
                $posicao = array_shift($disponiveis);
            } else {
                $posicao = array_pop($ocupados) + 7;
                break;
            }
            $result = EventoMapa::join('ave', 'ave.id', '=', 'evento_mapa.id_ave')
                                ->join('usuario', 'usuario.documento', '=', 'ave.criador_cpf')
                                ->whereRaw("sequencia BETWEEN ($posicao - 6) AND ($posicao + 6) AND id_evento = $evento AND usuario.documento = $cpf")->get();
        }while(count($result) > 0);


        return $posicao;
    }

    public static function imprimirFicha($campeonato, $evento, $tipo_ave, $prova, $cpf, $sequencia){
        
        /**

        /#------ Não esquecer de fazer a checagem se há ou não ave acompanhante -------#/
        /#------                Retornar uma view nessa função                  -------#/
        
        **/
        
        $resultado = EventoMapa::whereEvento($evento)
                                ->whereTipo_ave($tipo_ave)
                                ->whereProva($prova)
                                ->whereSequencia($sequencia)
                                ->whereCpf($cpf)
                                ->first();
        //return $resultado;

        $conta      = $resultado->conta;
        $lancto     = $resultado->lancto;
        $status     = $resultado->status;
        $criador    = Usuario::whereDocumento($cpf)->first();
        $clube      = Usuario::whereId($criador->id_clube)->first();
        $ave        = Ave::whereCriador_cpf($cpf)->whereAnilha($resultado->ave_anilha)->first();
        $ave_nome   = $ave->nome;
        $ave_acomp  = Ave::whereCriador_cpf($cpf)->whereAnilha($resultado->ave_acomp)->first();
        $prova      = Prova::whereTipoave($tipo_ave)->whereProva($prova)->first();
        $evento     = Evento::find($evento);

        $html = 'Resultado: '.$resultado.'<br /><br /><br /> PROVA: '.$prova.'<br /><table width="648" height="940" border="1" align="center" valign="top" cellpadding="1" cellspacing="0">';
        $html .= '  <tr class="grid_campo" align="center">';
        $html .= '      <td colspan="3"><b><strong><big>Ficha de Inscrição/Julgamento em Torneios - FEOSP</big></strong></b></td>';
        $html .= '  </tr>';
        $html .= '  <tr>';
        $html .= '      <td width="15%" class="grid_campo" align="center">';
        $html .= '          <img src="/imagens/avt' . $tipo_ave . '.jpg" width="70" height="70">';
        $html .= '      </td>';
        $html .= '      <td width="51%" class="grid_campo">';
        $html .= '          Data do Torneio ' .AzevedoDatas::toView($evento->data). '<br>';
        $html .= '      Evento: ' . $evento->descricao . ' / ' . $evento->temporada. '<br>';
        $html .= '      Etapa: ' . $evento->etapa. '<br>';
        $html .= '      Prova: ' . $prova->descricao;
        $html .= '      </td>';
        $html .= '      <td width="34%" class="grid_campo" align="center">';
        $html .= '          Nr Inscrição<br><b>'. $sequencia . '<br><br><span class="atencao">' . $resultado->ave_nome . '</span></b>';
        $html .= '      </td>';
        $html .= '  </tr>';
        $html .= '  <tr>';
        $html .= '      <td class="grid_campo" align="right">Ave</td>';
        $html .= '      <td colspan="2" class="grid_conteudo">';
        $html .= '      <b>Anilha:</b> ' . $resultado->ave_anilha . '&nbsp;&nbsp;<b>Acompanhante:</b> ' /*. $ave_acomp->ave_nome*/ . '&nbsp;&nbsp;<b>Anilha:</b> ' . $resultado[0]['AVE_ACOMP'];
        $html .= '      </td>';
        $html .= '  </tr>';
        $html .= '  <tr>';
        $html .= '      <td class="grid_campo" align="right">Proprietário</td>';
        $html .= '      <td colspan="2" class="grid_conteudo">';
        $html .= $criador[0]['NOME'] . ' <b>&nbsp;&nbsp;CPF:</b> ' . $cpf . '&nbsp;&nbsp;<b>Licença:</b> ' . $resultado->licenca;
        $html .= '      </td>';
        $html .= '  </tr>';
        $html .= '  <tr>';
        $html .= '      <td class="grid_campo" align="right">Clube</td>';
        $html .= '      <td colspan="2" class="grid_conteudo">';
        $html .= $clube->sigla . ' - ' . $clube->nome . ' (' . $clube->cidade . ' / ' . $clube->uf . ')<br>';
        $html .= '      </td>';
        $html .= '  </tr>';
        
        $html .= '  </tr>';
        $html .= '  <tr>';
        $html .= '      <td colspan="3" class="atencao" align="center">';
        $html .= '          Declaro estar ciente  e de acordo com o regulamento da FEOSP.';
        $html .= '      </td>';
        $html .= '  </tr>';
        $html .= '  <tr>';
        $html .= '      <td colspan="3" class="grid_campo" align="center">';
        $html .= '          <b><strong><big>Válida somente acompanhada de carimbo da Entidade ou Federação.</big></strong></b>';
        $html .= '      </td>';
        $html .= '  </tr>';

        // Ficha de Julgamento
        $html .= '  <tr>';
        $html .= '      <td colspan="3" class="grid_conteudo" align="center" valign="top">';
        $html .= '          <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">';
        if ($prova->tipores == 'N') {
            $html .= '              <tr class="grid_conteudo">';
            $html .= '                <td>';
            $html .= '                      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">';
            $html .= '                          <tr class="grid_campo">';
            $html .= '                              <td colspan="5" align="center">REQUISITOS QUALITATIVOS</td>';
            $html .= '                          </tr>';
            $html .= '                          <tr class="grid_campo" align="center">';
            $html .= '                              <td width="35%">Descrição</td>';
            $html .= '                              <td width="10%">Nota</td>';
            $html .= '                              <td width="10%">Peso</td>';
            $html .= '                              <td width="35%">Observações</td>';
            $html .= '                              <td width="10%">SubTotal</td>';
            $html .= '                          </tr>';
            $fichas = Ficha::whereTipoave($tipo_ave)->whereProva($prova)->whereTipo('Q')->get();
            //$fichas = ("SELECT * FROM FICHAS WHERE TIPOAVE = '$tipo_ave' AND PROVA = '$prova' AND TIPO = 'Q'");
            for ($i=0; $i<count($fichas); ++$i) {
                $html .= '                          <tr class="grid_small">';
                $html .= '                              <td>&nbsp;' . $fichas[$i]['DESCRICAO'] . '&nbsp;</td>';
                $html .= '                              <td>&nbsp;</td>';
                $html .= '                              <td align="right">&nbsp;' . $fichas[$i]['VALOR'] . '&nbsp;</td>';
                $html .= '                              <td>&nbsp;' . $fichas[$i]['OBSERVACAO'] . '&nbsp;</td>';
                $html .= '                              <td>&nbsp;</td>';
                $html .= '                          </tr>';
            }
            $html .= '                          <tr class="grid_campo">';
            $html .= '                              <td colspan="4" align="left">Sub Total (1)</td>';
            $html .= '                              <td width="10%">&nbsp;</td>';
            $html .= '                          </tr>';
            $html .= '                      </table>';
            $html .= '                      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">';
            $html .= '                          <tr class="grid_campo">';
            $html .= '                              <td colspan="5" align="center">DEDUÇÕES</td>';
            $html .= '                          </tr>';
            $html .= '                          <tr class="grid_campo" align="center">';
            $html .= '                              <td width="35%">Descrição</td>';
            $html .= '                              <td width="10%">Qtde</td>';
            $html .= '                              <td width="10%">Dedução</td>';
            $html .= '                              <td width="35%">Observações</td>';
            $html .= '                              <td width="10%">SubTotal</td>';
            $html .= '                          </tr>'.$fichas;
            $fichas = Ficha::whereTipoave($tipo_ave)->whereProva($prova)->whereTipo('D')->get();
           // $fichas = $database->Sql_Txt_Array("SELECT * FROM FICHAS WHERE TIPOAVE = '$tipo_ave' AND PROVA = '$prova' AND TIPO = 'D'");
            for ($i=0; $i<count($fichas); ++$i) {
                $html .= '                          <tr class="grid_small">';
                $html .= '                              <td>&nbsp;' . $fichas[$i]['DESCRICAO'] . '&nbsp;</td>';
                $html .= '                              <td>&nbsp;</td>';
                $html .= '                              <td align="right">&nbsp;' . $fichas[$i]['VALOR'] . '&nbsp;</td>';
                $html .= '                              <td>&nbsp;' . $fichas[$i]['OBSERVACAO'] . '&nbsp;</td>';
                $html .= '                              <td>&nbsp;</td>';
                $html .= '                          </tr>';
            }
            $html .= '                          <tr class="grid_campo">';
            $html .= '                              <td colspan="4" align="left">Sub Total (2)</td>';
            $html .= '                              <td width="10%">&nbsp;</td>';
            $html .= '                          </tr>';
            $html .= '                      </table>';
            $html .= '                      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">';

            if ($prova->repeticao == 'S') {
                $html .= '                          <tr class="grid_campo">';
                $html .= '                              <td colspan="6" align="left"><strong><big><b>NOTA FINAL com Repetição:______ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NOTA FINAL sem Repetição:______</b></big></strong></td>';
                $html .= '                          </tr>';
            } else {
                $html .= '                          <tr class="grid_campo">';
                $html .= '                              <td colspan="5" align="left"><strong><big><b>NOTA FINAL</b></big></strong></td>';
                $html .= '                              <td width="10%">&nbsp;</td>';
                $html .= '                          </tr>';
            }

            $html .= '                      </table>';
            $html .= '                </td>';
            $html .= '              </tr>';
        } else if ($prova->tipores == 'C') {
            $html .= '              <tr class="grid_conteudo">';
            $html .= '                <td>';
            $html .= '                      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">';
            $html .= '                          <tr class="grid_campo">';
            $html .= '                              <td colspan="20" align="center">MARCAÇÃO CLASSIFICATÓRIA</td>';
            $html .= '                              <td width="20%" align="center">VISTO FISCAL</td>';
            $html .= '                          </tr>';
            $quebra = 2;
            for ($i=1; $i<300; $i=$i+20) {
                ++$quebra;
                $html .= '                          <tr class="grid_conteudo">';
                for ($j=$i; $j<$i+20; ++$j) {
                    $html .= '                          <td width="4%" align="center">' . $j . '</td>';
                }
                if ($quebra == 3) {
                    $html .= '                              <td width="20%" rowspan="3">&nbsp;</td>';
                    $quebra = 0;
                }
                $html .= '                          </tr>';
            }
            $html .= '                      </table>';

            $html .= '                      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">';
            $html .= '                          <tr class="grid_campo">';
            $html .= '                              <td colspan="20" align="center">MARCAÇÃO FINAL</td>';
            $html .= '                              <td width="20%" align="center">VISTO FISCAL</td>';
            $html .= '                          </tr>';
            $quebra = 2;
            for ($i=1; $i<300; $i=$i+20) {
                ++$quebra;
                $html .= '                          <tr class="grid_conteudo">';
                for ($j=$i; $j<$i+20; ++$j) {
                    $html .= '                          <td width="4%" align="center">' . $j . '</td>';
                }
                if ($quebra == 3) {
                    $html .= '                              <td width="20%" rowspan="3">&nbsp;</td>';
                    $quebra = 0;
                }
                $html .= '                          </tr>';
            }
            $html .= '                      </table>';
            $html .= '                </td>';
            $html .= '              </tr>';
        } else if ($prova->tipores == 'T') {
            $html .= '              <tr class="grid_campo">';
            $html .= '                  <td align="center"><br>';
            $html .= '                      Tempo Classificatório: ____________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempo Final: ____________';
            $html .= '          </td>';
            $html .= '              </tr>';
        }
        $html .= '              <tr class="grid_campo">';
        $html .= '                  <td height="75" align="center" valign="top">';
        $html .= '                      <table width="100%" border="1" align="center" cellpadding="1" cellspacing="0">';
        $html .= '                          <tr height="100" align="center" valign="top" class="grid_campo">';
        $html .= '                              <td width="75%">OBSERVAÇÕES</td>';
        $html .= '                              <td width="25%">';
        $html .= '                                  CARIMBO';
        if ($status == 'PG') {
            $html .= '<br><img src="/imagens/carimbo-pago.png" width="50" height="50"> PAGO';
        }
        $html .= '                              </td>';
        $html .= '                          </tr>';
        $html .= '                      </table>';
        $html .= '                  </td>';
        $html .= '              </tr>';
        $html .= '              <tr class="grid_campo">';
        $html .= '                  <td align="center">';
        $html .= '                      [ &nbsp;&nbsp; ] Fora Regulamento &nbsp;&nbsp;&nbsp;&nbsp;[ &nbsp;&nbsp; ] Não Cantou &nbsp;&nbsp;&nbsp;&nbsp;[ &nbsp;&nbsp; ] Desclassificação &nbsp;&nbsp;&nbsp;&nbsp;[ &nbsp;&nbsp; ] Não Compareceu';
        $html .= '                  </td>';
        $html .= '              </tr>';
        $html .= '              <tr class="grid_campo">';
        $html .= '                  <td height="75" align="center" valign="bottom">';
        $html .= '                      <table width="100%" border="0" align="center" cellpadding="1" cellspacing="0">';
        $html .= '                          <tr align="center">';
        $html .= '                              <td width="33%"><hr></td>';
        $html .= '                              <td width="33%"></td>';
        $html .= '                              <td width="33%"><hr></td>';
        $html .= '                          </tr>';
        $html .= '                          <tr align="center" class="grid_campo">';
        $html .= '                              <td width="33%">JUIZ</td>';
        $html .= '                              <td width="33%"></td>';
        $html .= '                              <td width="33%">MESÁRIO</td>';
        $html .= '                          </tr>';
        $html .= '                      </table>';
        $html .= '                  </td>';
        $html .= '              </tr>';
        $html .= '          </table>';
        $html .= '      </td>';
        $html .= '  </tr>';

        $html .= '  <tr>';
        $html .= '      <td colspan="3" class="grid_conteudo" align="left">';
        $html .= '&nbsp; Versão: 10.4 | IP Cliente: ' . $_SERVER['REMOTE_ADDR'] . ' | Chave de autenticação: ' . date('YmdHis') . crypt(date('YmdHis'));
        $html .= '      </td>';
        $html .= '  </tr>';
        $html .= '</table>';
        $html .= '<br>';
        if (($conta != '') && ($lancto > 0)) {
            $link_boleto = ' | <a href="http://www.torneios.org.br/boletos/' . $conta . '/' . $lancto . '/" target="_blank">Imprimir Boleto</a>';
            if ($status == 'PG') {
                $link_boleto = ' | Boleto PAGO';
            }
        }
        // $html .= '<div align="center"><a href="javascript:window.print()"><img src="../imagens/printer.png" align="middle"></a>' . $link_boleto . '<br>' . $link . '</div>';
       // if ($link != '') {
         //   $html .= '<div align="center">[ <a href="javascript:window.print()">Imprimir Ficha de Inscrição</a>' . $link_boleto . ' | ' . $link . ' ]</div>';
        //}
        
        return $html;
        ###### Fazer retornar uma view####
    }   /*
        *
        *
        */
}