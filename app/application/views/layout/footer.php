<footer class="footer footer-transparent d-print-none">
          <div class="container">
        
          </div>
        </footer>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="<?php echo base_url('public/assets/js/tabler.min.js')?>"></script>
    <script src="<?php echo base_url('public/assets/libs/jquery/dist/jquery.min.js')?>"></script>
    <script src="<?php echo base_url('public/assets/js/util.js')?>"></script>

   <?php if(isset($scripts)): ?>
     <?php foreach($scripts as $script): ?>
      <script src="<?php echo base_url('/'. $script)?>"></script>
     <?php endforeach; ?>
   <?php endif; ?>

  </body>
  </html>