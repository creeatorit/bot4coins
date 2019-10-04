<?php
// A sessão precisa ser iniciada em cada página diferente
if (!isset($_SESSION)) session_start();

$nivel_necessario = 1;

// Verifica se não há a variável da sessão que identifica o usuário
//if (!isset($_SESSION['UsuarioID']) AND ($_SESSION['UsuarioNivel'] >$nivel_necessario) OR ($_SESSION['UsuarioNivel'] <$nivel_necessario2)) {
if (!isset($_SESSION['UsuarioID']) or ($_SESSION['UsuarioNivel'] < $nivel_necessario)) {
    // Destrói a sessão por segurança
    session_destroy();
    // Redireciona o visitante de volta pro login
    header("Location: login");
    exit;
} ?>

<!-- Chama o cabeçalho e o menu -->
<?php include("includes/header.php");?>
         
          <!-- PAGE CONTENT -->
          <div class="right_col" role="main">
            <div class="clearfix"></div>
            <div class="header-title-breadcrumb element-box-shadow">
              <div class="container">
                  <div class="row">
                      <div class="col-md-7 col-sm-6 col-xs-12 text-left">
                        <h3>Dúvidas Frequentes</h3>
                      </div>                      
                  </div>
              </div>
            </div>
            <div class="spacer_30"></div>
            <div class="clearfix"></div>
            <main class="cd-main-content">
              <div class="clearfix"></div>
              <div class="spacer_30"></div>
              <div class="clearfix"></div>
              <div class="panel-group accordion version1">
                <div class="panel panel-default">
                  <div class="panel-heading padding_30">
                    <i class="cc BTC" title="BTC"></i>
                    <h3 class="no-margin">All about Bitcoin</h3>
                  </div>
                  <div class="panel-body no-padding">
                    <div class="collapseOne1 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">What is Bitcoin?</a>
                        </h4>
                      </div>
                      <div id="collapseOne1" class="panel-collapse collapse">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quidem blanditiis delectus corporis, possimus officia sint sequi ex tenetur id impedit est pariatur iure animi non a ratione reiciendis nihil sed consequatur atque repellendus fugit perspiciatis rerum et. Dolorum consequuntur fugit deleniti, soluta fuga nobis. Ducimus blanditiis velit sit iste delectus obcaecati debitis omnis, assumenda accusamus cumque perferendis eos aut quidem! Aut, totam rerum, cupiditate quae aperiam voluptas rem inventore quas, ex maxime culpa nam soluta labore at amet nihil laborum? Explicabo numquam, sit fugit, voluptatem autem atque quis quam voluptate fugiat earum rem hic, reprehenderit quaerat tempore at. Aperiam.
                      </div>
                    </div>
                    <div class="collapseOne2 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne2">Where can i find Bitcoin?</a>
                        </h4>
                      </div>
                      <div id="collapseOne2" class="panel-collapse collapse">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                      </div>
                    </div>
                    <div class="collapseOne3 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne3">How does Bitcoin work?</a>
                        </h4>
                      </div>
                      <div id="collapseOne3" class="panel-collapse collapse">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quidem blanditiis delectus corporis, possimus officia sint sequi ex tenetur id impedit est pariatur iure animi non a ratione reiciendis nihil sed consequatur atque repellendus fugit perspiciatis rerum et. Dolorum consequuntur fugit deleniti, soluta fuga nobis. Ducimus blanditiis velit sit iste delectus obcaecati debitis omnis, assumenda accusamus cumque perferendis eos aut quidem! Aut, totam rerum, cupiditate quae aperiam voluptas rem inventore quas, ex maxime culpa nam soluta labore at amet nihil laborum? Explicabo numquam, sit fugit, voluptatem autem atque quis quam voluptate fugiat earum rem hic, reprehenderit quaerat tempore at. Aperiam.
                      </div>
                    </div>
                    <div class="collapseOne4 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne4">What is Mining?</a>
                        </h4>
                      </div>
                      <div id="collapseOne4" class="panel-collapse collapse">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quidem blanditiis delectus corporis, possimus officia sint sequi ex tenetur id impedit est pariatur iure animi non a ratione reiciendis nihil sed consequatur atque repellendus fugit perspiciatis rerum et. Dolorum consequuntur fugit deleniti, soluta fuga nobis. Ducimus blanditiis velit sit iste delectus obcaecati debitis omnis, assumenda accusamus cumque perferendis eos aut quidem! Aut, totam rerum, cupiditate quae aperiam voluptas rem inventore quas, ex maxime culpa nam soluta labore at amet nihil laborum? Explicabo numquam, sit fugit, voluptatem autem atque quis quam voluptate fugiat earum rem hic, reprehenderit quaerat tempore at. Aperiam.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="spacer_30"></div>
                <div class="clearfix"></div>
                <div class="panel panel-default">
                  <div class="panel-heading padding_30">
                    <i class="cc ETH" title="ETH"></i>
                    <h3 class="no-margin">All about Ethereum</h3>
                  </div>
                  <div class="panel-body no-padding">
                    <div class="collapseTwo1 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo1">What is Ethereum?</a>
                        </h4>
                      </div>
                      <div id="collapseTwo1" class="panel-collapse collapse">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quidem blanditiis delectus corporis, possimus officia sint sequi ex tenetur id impedit est pariatur iure animi non a ratione reiciendis nihil sed consequatur atque repellendus fugit perspiciatis rerum et. Dolorum consequuntur fugit deleniti, soluta fuga nobis. Ducimus blanditiis velit sit iste delectus obcaecati debitis omnis, assumenda accusamus cumque perferendis eos aut quidem! Aut, totam rerum, cupiditate quae aperiam voluptas rem inventore quas, ex maxime culpa nam soluta labore at amet nihil laborum? Explicabo numquam, sit fugit, voluptatem autem atque quis quam voluptate fugiat earum rem hic, reprehenderit quaerat tempore at. Aperiam.
                      </div>
                    </div>
                    <div class="collapseTwo2 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo2">Where can i find Ethereum?</a>
                        </h4>
                      </div>
                      <div id="collapseTwo2" class="panel-collapse collapse">
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                        Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.
                      </div>
                    </div>
                    <div class="collapseTwo3 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo3">How does Ethereum work?</a>
                        </h4>
                      </div>
                      <div id="collapseTwo3" class="panel-collapse collapse">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quidem blanditiis delectus corporis, possimus officia sint sequi ex tenetur id impedit est pariatur iure animi non a ratione reiciendis nihil sed consequatur atque repellendus fugit perspiciatis rerum et. Dolorum consequuntur fugit deleniti, soluta fuga nobis. Ducimus blanditiis velit sit iste delectus obcaecati debitis omnis, assumenda accusamus cumque perferendis eos aut quidem! Aut, totam rerum, cupiditate quae aperiam voluptas rem inventore quas, ex maxime culpa nam soluta labore at amet nihil laborum? Explicabo numquam, sit fugit, voluptatem autem atque quis quam voluptate fugiat earum rem hic, reprehenderit quaerat tempore at. Aperiam.
                      </div>
                    </div>
                    <div class="collapseTwo4 border-faq">
                      <div class="faq-header">
                        <h4 class="panel-title">
                          <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo4">What is Mining?</a>
                        </h4>
                      </div>
                      <div id="collapseTwo4" class="panel-collapse collapse">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae quidem blanditiis delectus corporis, possimus officia sint sequi ex tenetur id impedit est pariatur iure animi non a ratione reiciendis nihil sed consequatur atque repellendus fugit perspiciatis rerum et. Dolorum consequuntur fugit deleniti, soluta fuga nobis. Ducimus blanditiis velit sit iste delectus obcaecati debitis omnis, assumenda accusamus cumque perferendis eos aut quidem! Aut, totam rerum, cupiditate quae aperiam voluptas rem inventore quas, ex maxime culpa nam soluta labore at amet nihil laborum? Explicabo numquam, sit fugit, voluptatem autem atque quis quam voluptate fugiat earum rem hic, reprehenderit quaerat tempore at. Aperiam.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
            </main>
          </div>

          <!-- Chama o rodapé -->
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
      <script src="assets/js/custom.min.js"></script>
      <script src="assets/js/preloader.min.js"></script>
      <script>
        jQuery(document).ready(function($){
          $( "#version2" ).on("click", function() {
            $( "#version1" ).removeClass( "selected" );
            $( "#version2" ).addClass( "selected" );
            $(".version1").css("display","none");
            $(".version2").css("display","block");
          });
          $( "#version1" ).on("click", function() {
            $( "#version2" ).removeClass( "selected" );
            $( "#version1" ).addClass( "selected" );
            $(".version2").css("display","none");
            $(".version1").css("display","block");
          });
        });
      </script>
    </div>
  </body>
</html>
