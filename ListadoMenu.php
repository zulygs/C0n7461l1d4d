 <?php if ($_SESSION['idUser'] == 9 || $_SESSION['idUser'] == 24 || $_SESSION['idUser'] == 34|| $_SESSION['user'] == 'jsilva') {?>
           <li >
           <a href="Conta.php">
           <i><img src="assets/img/tarjetaC.ico"></i>
           <p>Pagos Con Tarjeta</p>
           </a>
           </li>
           <li >
           <a href="Reporte_POS.php">
           <i><img src="https://img.icons8.com/external-flat-juicy-fish/60/000000/external-pos-banking-flat-flat-juicy-fish.png"></i>
           <p>Pagos Con POS</p>
           </a>
           </li>
           <li >
           <a href="FacturasConsumoFechas.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Facturas Fel por  Agencias</p>
           </a>
           </li>
            <li >
           <a href="FacturasConsumoMes.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Facturas Canon</p>
           </a>
           </li>
           <!--<li >
           <a href="SerieD.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie D</p>
           </a>
           </li>
           <li >
           <a href="SerieSC.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie SC -SankrisMall <br>Manuales</p>
           </a>
           </li>
           <li >
           <a href="SerieSM.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie SM-Sankris Mall</p>
           </a>
           </li>
           <li >
           <a href="SerieMF.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie MF -MegaFrater</p>
           </a>
           </li>
           <li >
           <a href="SerieOF.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie OF -Oficina <br> Central</p>
           </a>
           </li>
         <li >
           <a href="SerieCT.php">
           <i><img src="assets/img/10.ico"></i>
           <p>Serie CT Facturación</p>
           </a>
           </li>-->
           <li >
           <a href="Resumen.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Resumen Total De <br>Series</p>
           </a>
           </li>
           
           <li >
           <a href="NotaCredito.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Notas de Credito</p>
           </a>
           </li>
           <li >
           <a href="Anulaciones.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Anular Notas de Credito</p>
           </a>
           </li>
           <li>
           <a href="Re_SolicitudesU.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Verificar Anulaciones</p>
           </a>
           </li>
            <li >
           <a href="AnulacionesReporte.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Reporte De Anulaciones</p>
           </a>
           </li>
           <li >
           <a href="IVA.php">
           <i><img src="assets/img/12.png"></i>
           <p>Extenciones de IVA</p>
           </a>
           </li>
           <li >
           <a href="IngresoPorDia.php">
           <i><img src="assets/img/mensual.ico"></i>
           <p>Ingreso por Dia</p>
           </a>
           </li>

           <li >
           <a href="unidentified.php">
           <i><img src="assets/img/buscar.ico"></i>
           <p>Cargas de Pagos <br>No Identificados</p>
           </a>
           </li>
            <li>
            <a href="https://sistemac.sascim.com.gt/public/sistemac" target="_blank">
            <i><img src="assets/img/recibo1.ico"></i>
              Reenvío De Comprobante
            </a>
          </li>
          <?php if ($_SESSION['idUser'] == 24 ): ?>
             <li>
            <a href="Planilla.php" target="_blank">
            <i><img src="assets/img/recibo1.ico"></i>
              Planilla
            </a>
          </li>

          <?php endif ?>
           <li >
            <a href="salir.php">
             <span>
                <i><img src="assets/img/salir.ico"></i>
              </span>
              <p>Salir</p>
            </a>
          </li> 
           <!--<li >
           <a href="formulario5.php">
           <i><img src="assets/img/calendar.ico"></i>
           <p>Ingreso mensual</p>
           </a>
           </li>-->
       

        <?php }?>


        <?php if ($_SESSION['idUser'] == 1) {?>
         <!-- <li >
           <a href="Usuarios.php">
           <i><img src="assets/img/user.ico"></i>
           <p>usuarios</p>
           </a>
           </li>-->
           
            <li >
           <a href="Conta.php">
           <i><img src="assets/img/tarjetaC.ico"></i>
           <p>Pagos Con Tarjeta</p>
           </a>
           </li>
           <li >
           <a href="Reporte_POS.php">
           <i><img src="https://img.icons8.com/external-flat-juicy-fish/60/000000/external-pos-banking-flat-flat-juicy-fish.png"></i>
           <p>Pagos Con POS</p>
           </a>
           </li>
           <li >
           <a href="FacturasConsumoFechas.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Facturas Fel por  Agencias</p>
           </a>
           </li>
            <li >
           <a href="FacturasConsumoMes.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Facturas Canon</p>
           </a>
           </li>
           <!--<li >
           <a href="SerieD.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie D</p>
           </a>
           </li>
           <li >
           <a href="SerieSC.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie SC -SankrisMall <br>Manuales</p>
           </a>
           </li>
           <li >
           <a href="SerieSM.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie SM-SankrisMall</p>
           </a>
           </li>
           <li >
           <a href="SerieMF.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie MF -MegaFrater</p>
           </a>
           </li>
            <li >
           <a href="SerieOF.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Serie OF -Oficina <br>Central</p>
           </a>
           </li>
         <li >
           <a href="SerieCT.php">
           <i><img src="assets/img/10.ico"></i>
           <p>Serie CT Facturación</p>
           </a>
           </li>-->
           <li>
           <a href="Resumen.php">
           <i><img src="assets/img/3.ico"></i>
           <p>Resumen total De <br>Series</p>
           </a>
           </li>
           
           <li >
           <a href="NotaCredito.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Notas de Credito</p>
           </a>
           </li>
           <li >
           <a href="Anulaciones.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Anular Notas de <br>Credito</p>
           </a>
           </li>
           <li>
           <a href="Re_SolicitudesU.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Verificar Anulaciones</p>
           </a>
           </li>
            <li >
           <a href="AnulacionesReporte.php">
           <i><img src="assets/img/8.ico"></i>
           <p>Reporte De Anulaciones</p>
           </a>
           </li>
           <li >
           <a href="IVA.php">
           <i><img src="assets/img/12.png"></i>
           <p>Extenciones de IVA</p>
           </a>
           </li>
            <li >
           <a href="IngresoPorDia.php">
           <i><img src="assets/img/mensual.ico"></i>
           <p>Ingreso por Dia</p>
           </a>
           </li>
            <li >
           <a href="IngresoCajaDia.php">
           <i><img src="assets/img/mensual.ico"></i>
           <p>Ingreso De Caja Por <br> Dia</p>
           </a>
           </li>
             <li >
           <a href="unidentified.php">
           <i><img src="assets/img/buscar.ico"></i>
           <p>Cargas de Pagos <br>No Identificados</p>
           </a>
           </li>
            <li>
            <a href="https://sistemac.sascim.com.gt/public/sistemac" target="_blank">
            <i><img src="assets/img/recibo1.ico"></i>
              Reenvío De Comprobante
            </a>
          </li>
           <li >
            <a href="salir.php">
             <span>
                <i><img src="assets/img/salir.ico"></i>
              </span>
              <p>Salir</p>
            </a>
          </li> 
           
            
           <!--<li >
           <a href="formulario5.php">
           <i><img src="assets/img/calendar.ico"></i>
           <p>Ingreso mensual</p>
           </a>
           </li>-->
           

        <?php }?>
