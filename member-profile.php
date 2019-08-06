<!-- Chama o cabeçalho e o menu -->
<?php include("includes/header.php");?>

<?php
// Chama função para pegar o POST de cada FORM
function get_post_action($name)
{
    $params = func_get_args();

    foreach ($params as $name) {
        if (isset($_POST[$name])) {
            return $name;
        }
    }
}


// Verifica qual botao foi clicado
switch (get_post_action('button_pessoais', 'button_senha', 'button_endereco', 'button_banco')) {

  case 'button_pessoais':

      $nome       = $_POST['nome'];
      $sobrenome  = $_POST['sobrenome'];
      $nascimento = $_POST['nascimento'];
      $rg         = $_POST['rg'];
      $cpf        = $_POST['cpf'];
      $sexo       = $_POST['sexo'];
      $email      = $_POST['email'];
      $telefone   = $_POST['telefone'];

      // verifica se usuario preencheu campos obrigatorios
      $validacao = true;

      if ($validacao) {

              /* INICIA INSERÇÃO DAS IMAGENS NA PASTA */
              $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
              $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

              $foto = $_FILES['foto'];
              
              if (count($foto) > 0) {
                for ($q = 0; $q < count($foto['tmp_name']); $q++) {
                    $tipo = $foto['type'][$q];
                    if (in_array($tipo, array('image/jpeg', 'image/png'))) {

                        //nome gerado para a imagem a cada loop
                        $tmpname = md5(time() . rand(0, 999)) . '.jpeg';

                        //aqui a imagem ja é movida (upload) para a pasta (assets/img/anuncios/) com seu novo name ($tmpname)
                        move_uploaded_file($foto['tmp_name'][$q], 'assets/images/img_profiles/' . $tmpname);

                        //daqui pra baixo é um brinde kkk, apenas para criarmos uma nova imagem com largura, altura desejados
                        list($larg_orig, $alt_orig) = getimagesize('assets/images/img_profiles/' . $tmpname);
                        $tamanho = $larg_orig / $alt_orig;

                        $largura = 300;
                        $altura = 300;

                        if ($largura / $altura > $tamanho) {
                            $largura = $altura * $tamanho;
                        } else {
                            $altura = $largura / $tamanho;
                        }
                        $img = imagecreatetruecolor($largura, $altura);
                        if ($tipo == 'image/jpeg') {
                            $original = imagecreatefromjpeg('assets/images/img_profiles/' . $tmpname);
                        } elseif ($tipo == 'image/png') {
                            $original = imagecreatefrompng('assets/images/img_profiles/' . $tmpname);
                        }
                        imagecopyresampled($img, $original, 0, 0, 0, 0, $largura, $altura, $larg_orig, $alt_orig);

                        imagejpeg($img, 'assets/images/img_profiles/' . $tmpname, 80);

                        // aqui ja faço a inserção de cada novo name da imagem no banco de dados
                        //$sql = $pdo->prepare("INSERT INTO usuarios (foto) VALUES (:foto)");                        
                        //$sqlfoto->bindValue(":foto", $tmpname);
                        //$sqlfoto->execute();

                        $sqlfoto = $pdo->prepare('INSERT INTO usuarios (foto) VALUES (:foto) WHERE id = "' . $_SESSION['UsuarioID'] . '" ');
                        $sqlfoto->bindValue(":foto", $tmpname);
                        $sqlfoto->execute();
                    }
                }
              }

              $sqlpessoais = 'UPDATE usuarios set nome = ?, sobrenome = ?, nascimento = ?, rg = ?, cpf = ?, sexo = ?, email = ?, telefone = ? WHERE id = "' . $_SESSION['UsuarioID'] . '"  ';
              $q = $pdo->prepare($sqlpessoais);
              $q->execute(array($nome, $sobrenome, $nascimento, $rg, $cpf, $sexo, $email, $telefone));
              echo "<script>alert('DETALHES PESSOAIS ALTERADOS COM SUCESSO!');</script>";
      }
      break;
  
  case 'button_senha':

      $senha = sha1($_POST['senha']);

      // verifica se usuario preencheu campos obrigatorios
      $validacao = true;

      if ($validacao) {

              $sqlpessoais = 'UPDATE usuarios set senha = ? WHERE id = "' . $_SESSION['UsuarioID'] . '"  ';
              $q = $pdo->prepare($sqlpessoais);
              $q->execute(array($senha));
              echo "<script>alert('SENHA PESSOAL ALTERADA COM SUCESSO!');</script>";
      }
      break;

  case 'button_endereco':

      $cep         = $_POST['cep'];
      $endereco    = $_POST['endereco'];
      $bairro      = $_POST['bairro'];
      $numero      = $_POST['numero'];
      $complemento = $_POST['complemento'];
      $cidade      = $_POST['cidade'];
      $estado      = $_POST['estado'];

      if($complemento == ''){
        $complemento = 'NENHUM';
      }

      $validacao = true;

      // começa a SALVAR antes de fechar
      if ($validacao) {

              $sqlendereco = 'UPDATE usuarios set cep = ?, endereco = ?, bairro = ?, numero = ?, complemento = ?, cidade = ?, estado = ?  WHERE id = "' . $_SESSION['UsuarioID'] . '"  ';
              $q = $pdo->prepare($sqlendereco);
              $q->execute(array($cep, $endereco, $bairro, $numero, $complemento, $cidade, $estado));
              echo "<script>alert('DADOS DO ENDEREÇO ALTERADO COM SUCESSO!');</script>";
      }
      break;

  case 'button_banco':

      $banco      = $_POST['banco'];
      $agencia    = $_POST['agencia'];
      $conta      = $_POST['conta'];
      $conta_tipo = $_POST['conta_tipo'];

      $validacao = true;

      // começa a SALVAR antes de fechar
      if ($validacao) {

              $sqlbanco = 'UPDATE usuarios set banco = ?, agencia = ?, conta = ?, conta_tipo = ? WHERE id = "' . $_SESSION['UsuarioID'] . '"  ';
              $q = $pdo->prepare($sqlbanco);
              $q->execute(array($banco, $agencia, $conta, $conta_tipo));
              echo "<script>alert('DADOS BANCÁRIOS ALTERADOS COM SUCESSO!');</script>";
      }
      break;

  default:
      
  }


$pdo = Banco::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$sql = 'SELECT * FROM usuarios where id = "'.$_SESSION['UsuarioID'].'" ';
$q = $pdo->prepare($sql);
$q->execute(array($id));
$data = $q->fetch(PDO::FETCH_ASSOC);
?>
         
          <!-- PAGE CONTENT -->
          <div class="right_col" role="main">
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <div class="container">
              <div class="row">
                <div class="col-md-12 col-lg-4">
                  <div class="panel element-box-shadow">
                    <div class="section1 text-center">
                      <div class="top animated bounceIn">
                      </div>
                      
                      <div id="user-image-v1">
                        <div id="container">
                          <div class="box">
                            <div class="progress"></div>
                          </div>
                          <div class="v-align">
                            <img src="assets/images/img_profiles/<?php echo $data['foto']; ?>" >
                            <div class="arrow"></div>
                          </div>
                        </div>

                      </div>
                      <div class="clearfix"></div>
                      <div class="spacer_80"></div>
                      <div class="spacer_70"></div>
                      <div class="clearfix"></div>
                      <h3 class="text-bold"><?php echo $data['nome']; ?></h3>
                      <h4 class="text-bold"><i class="fa fa-envelope-o"></i> <?php echo $data['email']; ?></h4>
                      <?php if($data['telefone'] != '') { ?>
                      <h4 class="text-bold"><i class="fa fa-phone"></i> <?php echo $data['telefone']; ?></h4>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                
                <div class="col-md-12 col-lg-8">
                  
                  <!-- Dados Pessoais -->
                  <div class="panel panel-cryptic element-box-shadow">
                    <div class="panel-heading padding_30">
                      <h3 class="no-margin">Detalhes Pessoais</h3>
                    </div>
                    <div class="panel-body padding_30">
                      <form class="form-horizontal" action="member-profile" method="POST">
                        <fieldset>
                          <div class="form-group">
                            <label for="inputPhoto" class="col-lg-12 control-label">Foto do Perfil</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="foto" name="foto" type="file" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputFirstName" class="col-lg-12 control-label">Primeiro nome</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="nome" name="nome" value="<?php echo $data['nome']; ?>" type="text" autocomplete="off" onChange="this.value=this.value.toUpperCase()" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputLastName" class="col-lg-12 control-label">Sobrenome</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="sobrenome" name="sobrenome" value="<?php echo $data['sobrenome']; ?>" type="text" autocomplete="off" onChange="this.value=this.value.toUpperCase()" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputBritday" class="col-lg-12 control-label">Nascimento</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="nascimento" name="nascimento" value="<?php echo $data['nascimento']; ?>" type="date" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputRg" class="col-lg-12 control-label">RG</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="rg" name="rg" value="<?php echo $data['rg']; ?>" type="number" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCPF" class="col-lg-12 control-label">CPF</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="cpf" name="cpf" value="<?php echo $data['cpf']; ?>" type="number" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputLastSexy" class="col-lg-12 control-label">Sexo</label>
                            <div class="col-lg-12">
                              <select class="form-control input-type-1" id="sexo" name="sexo" type="text" autocomplete="off" required>
                              <option value="<?php echo $data['sexo']; ?>" ><?php echo $data['sexo']; ?></option>
                                <option value="FEMININO">FEMININO</option>
                                <option value="MASCULINO">MASCULINO</option>
                                <option value="NÃO ESPECIFICADO">NÃO ESPECIFICADO</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputEmail" class="col-lg-12 control-label">Email</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="email" name="email" value="<?php echo $data['email']; ?>" type="text" autocomplete="off" onChange="this.value=this.value.toLowerCase()" readonly>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputPhone" class="col-lg-12 control-label">Telefone</label>
                            <div class="col-lg-12">
                              <input class="form-control" id="telefone" name="telefone" value="<?php echo $data['telefone']; ?>" type="text" maxlength="16" autocomplete="off" required>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-cryptic button-element" name="button_pessoais">Salvar</button>
                        </fieldset>
                      </form>
                    </div>
                  </div>

                  <!-- Senha de Acesso -->
                  <div class="panel panel-cryptic element-box-shadow">
                    <div class="panel-heading padding_30">
                      <h3 class="no-margin">Alterar Senha de Acesso</h3>
                    </div>
                    <div class="panel-body padding_30">
                      <form class="form-horizontal" action="member-profile" method="POST">
                        <fieldset>
                          <div class="form-group">
                            <label for="inputPhone" class="col-lg-12 control-label">Senha</label>
                            <div class="col-lg-12">
                              <input class="form-control" id="senha" name="senha" value="<?php echo $data['senha']; ?>" type="password" autocomplete="off" required>
                            </div>
                          </div>
                          <button type="submit" class="btn btn-cryptic button-element" name="button_senha">Salvar</button>
                        </fieldset>
                      </form>
                    </div>
                  </div>

                  <!-- Dados Endereço -->
                  <div class="panel panel-cryptic element-box-shadow">
                    <div class="panel-heading padding_30">
                      <h3 class="no-margin">Endereço</h3>
                    </div>
                    <div class="panel-body padding_30">
                      <form class="form-horizontal" action="member-profile" method="POST">
                        <fieldset>
                          <div class="form-group">
                                <label for="inputPostCode" class="col-lg-12 control-label">CEP</label>
                                <div class="col-lg-12">
                                  <input class="form-control input-type-1" id="cep" name="cep" value="<?php echo $data['cep']; ?>" placeholder="80000-000" type="text" autocomplete="off" required>
                                </div>
                          </div>
                          <div class="form-group">
                            <label for="inputStreet" class="col-lg-12 control-label">rua</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="endereco" name="endereco" value="<?php echo $data['endereco']; ?>" type="text" placeholder="RUA DOM JOSÉ" autocomplete="off" onChange="this.value=this.value.toUpperCase()" required>
                            </div>
                          </div>
                          <div class="form-group">
                              <label for="inputStreet" class="col-lg-12 control-label">bairro</label>
                              <div class="col-lg-12">
                                <input class="form-control input-type-1" id="bairro" name="bairro" value="<?php echo $data['bairro']; ?>" placeholder="CENTRO" type="text" autocomplete="off" onChange="this.value=this.value.toUpperCase()" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputStreet" class="col-lg-12 control-label">número</label>
                              <div class="col-lg-12">
                                <input class="form-control input-type-1" id="numero" name="numero" value="<?php echo $data['numero']; ?>" type="text" placeholder="123" autocomplete="off" onChange="this.value=this.value.toUpperCase()" required>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputComplement" class="col-lg-12 control-label">complemento</label>
                              <div class="col-lg-12">
                                <input class="form-control input-type-1" id="complemento" name="complemento" value="<?php echo $data['complemento']; ?>" type="text" placeholder="AP 01" autocomplete="off" onChange="this.value=this.value.toUpperCase()" required>
                              </div>
                          </div>
                          <div class="form-group">
                            <label for="inputCity" class="col-lg-12 control-label">cidade</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="cidade" name="cidade" value="<?php echo $data['cidade']; ?>" type="text" placeholder="CURITIBA" autocomplete="off" onChange="this.value=this.value.toUpperCase()" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputState" class="col-lg-12 control-label">estado</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="estado" name="estado" value="<?php echo $data['estado']; ?>" type="text" placeholder="PARANÁ" autocomplete="off" onChange="this.value=this.value.toUpperCase()" required>
                            </div>
                          </div>
                          <button class="btn btn-cryptic button-element" name="button_endereco">Salvar</button>
                        </fieldset>
                      </form>
                    </div>
                  </div>

                  <!-- Dados Bancários -->
                  <div class="panel panel-cryptic element-box-shadow">
                    <div class="panel-heading padding_30">
                      <h3 class="no-margin">Informações Bancárias</h3>
                    </div>
                    <div class="panel-body padding_30">
                      <form class="form-horizontal" action="member-profile" method="POST">
                        <fieldset>
                          <div class="form-group">
                            <label for="inputBank" class="col-lg-12 control-label">Banco</label>
                            <div class="col-lg-12">
                              <select class="form-control input-type-1" id="banco" name="banco" type="text" autocomplete="off" required>
                                <option value="<?php echo $data['banco']; ?>" ><?php echo $data['banco']; ?></option>
                                <option value="0001 - Banco do Brasil SA">001 - Banco do Brasil SA</option>
                              </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputAgency" class="col-lg-12 control-label">Agência</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="agencia" name="agencia" value="<?php echo $data['agencia']; ?>" placeholder="0001" type="text" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputAccount" class="col-lg-12 control-label">Conta</label>
                            <div class="col-lg-12">
                              <input class="form-control input-type-1" id="conta" name="conta" value="<?php echo $data['conta']; ?>" placeholder="31598-9" type="text" autocomplete="off" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="inputType" class="col-lg-12 control-label">Tipo</label>
                            <div class="col-lg-12">
                              <select class="form-control input-type-1" id="conta_tipo" name="conta_tipo" type="text" autocomplete="off" required>
                                <option value="<?php echo $data['conta_tipo']; ?>" ><?php if ($data['conta_tipo'] == 'CC') {
                                                                                            echo "CONTA CORRENTE";
                                                                                        } if ($data['conta_tipo'] == 'CP') {
                                                                                            echo "CONTA POUPANÇA";
                                                                                        } ?></option>
                                <option value="CC">CONTA CORRENTE</option>
                                <option value="CP">CONTA POUPANÇA</option>
                              </select>
                            </div>
                          </div>
                          <button class="btn btn-cryptic button-element" name="button_banco">Salvar</button>
                        </fieldset>
                      </form>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          
          <!-- Chama o Rodapé -->
          <?php include("includes/footer.php");?>

        </div>
      </div>
      <!-- JS SCRIPTS -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/jquery.scrollbar.min.js"></script>
      <script src="assets/plugins/modernizr/modernizr.custom.js"></script>
      <script src="assets/plugins/classie/classie.js"></script>  
      <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
      <!-- Custom Theme Scripts -->
      <script src="assets/js/preloader.min.js"></script>
      <script src="assets/js/custom.min.js"></script>
      <script src="assets/js/filereader.js"></script>
      <script src="assets/plugins/sweetalert/sweetalert.min.js"></script>

    </div>
  </body>
</html>
