<?php

/  ** DirectorioraízPHPExcel *  /
if (!define('PHPEXCEL_ROOT')) {
    define('PHPEXCEL_ROOT', dirname(__FILE__) . '/');
    require PHPEXCEL_ROOT . 'PHPExcel / Autoloader.php';
}

/  **
 * PHPExcel
 * *
 * Copyright(c)2006 - 2015PHPExcel
     * *
     * Estabibliotecaessoftwarelibre;
puedesredistribuirloy / o
     * ModifíquelobajolostérminosdelPúblicoGeneralMenordeGNU
     * LicenciapublicadaporlaFreeSoftwareFoundation;
yasea
 * versión2.1delaLicencia, o(asuelección)cualquierversiónposterior .
 * *
 * Estabibliotecasedistribuyeconlaesperanzadequeseaútil,
     * peroSINNINGUNAGARANTÍA;
sinsiquieralagarantíaimplícitade
     * COMERCIABILIDADoAPTITUDPARAUNPROPÓSITOENPARTICULAR . VerlaGNU
     * Licenciapúblicageneralmenorparamásdetalles .
     * *
     * DeberíahaberrecibidounacopiadelPúblicogeneralmenordeGNU
     * Licenciajuntoconestabiblioteca;
sino, escribaalsoftwarelibre
 * Foundation, Inc . , 51FranklinStreet, FifthFloor, Boston, MA02110 - 1301EE . UU .
 * *
 * @categoryPHPExcel
 * @packagePHPExcel
 * @copyrightCopyright(c)2006 - 2015PHPExcel(http: //www.codeplex.com/PHPExcel)
     * @licensehttp: //www.gnu.org/licenses/old-licenses/lgpl-2.1.txt LGPL
     * @versión## VERSIÓN ##, ## FECHA ##
     *  /
    clasePHPExcel {
        /  **
         * Identificaciónúnica
         * *
         * @cadena*/privadopublic $uniqueID;

        /  **
         * Propiedadesdeldocumento
         * *
         * @PHPExcel_DocumentProperties*/propiedadesprivadas$;/***Seguridaddedocumentos***@PHPExcel_DocumentSecurity*/seguridadprivada$;/***Coleccióndeobjetosdehojadetrabajo***@PHPExcel_Worksheet[]*/private $workSheetCollection = array();

        /  **
         * Motordecálculo
         * *
         * @PHPExcel_Calculation*/private $CalculationEngine;

        /  **
         * Índicedehojaactiva
         * *
         * @entero*/private $activeSheetIndex = 0;

        /  **
         * Rangosnombrados
         * *
         * @PHPExcel_NamedRange[]*/private $namedRanges = array();

        /  **
         * SupervisordeCellXf
         * *
         * @PHPExcel_Style*/private $cellXfSupervisor;

        /  **
         * ColecciónCellXf
         * *
         * @PHPExcel_Style[]*/private $cellXfCollection = array();

        /  **
         * ColecciónCellStyleXf
         * *
         * @PHPExcel_Style[]*/private $cellStyleXfCollection = array();

        /  **
         * hasMacros:estelibrodetrabajotienemacros ?
         * *
         * @bool*/private $hasMacros = false;

        /  **
         * macrosCode : todosloscódigosdemacros(elarchivovbaProject . bin, estoincluyeformulario, código, etc . ), nulosinohaymacro
         * *
         * @binario*/private $macrosCode;
        /  **
         * macrosCertificate:silasmacrosestánfirmadas, contieneelarchivovbaProjectSignature . bin, nulosinoestáfirmado
         * *
         * @binario*/private $macrosCertificate;

        /  **
         * ribbonXMLData:nulosiellibrodetrabajonoesExcel2007onocontieneunaIUpersonalizada
         * *
         * @null|string*/private $ribbonXMLData;

        /  **
         * ribbonBinObjects:nulosiellibrodetrabajonoesExcel2007onocontieneobjetosincrustados(imágenes)paraelementosdecinta
         * ignoradosi$ribbonXMLDataesnulo
         * *
         * @var null | array
         *  /
        private $ribbonBinObjects;

        /  **
         * ¿Ellibrotienemacros ?
         * *
         * @return booleantruesiellibrodetrabajotienemacros, falsesino
         *  /
        funciónpúblicahasMacros() {
            devuelve$this->hasMacros;
        }

        /  **
         * Definirsiunlibrodetrabajotienemacros
         * *
         * @paramboolean$hasMacrosverdadero | falso
         *  /
        funciónpúblicasetHasMacros($hasMacros = false) {
            $this->hasMacros = (bool) $hasMacros;
        }

        /  **
         * Establecerelcódigodemacros
         * *
         * @paramstring$MacrosCodestring | nulo
         *  /
        funciónpúblicasetMacrosCode($MacrosCode = null) {
            $this->macrosCode = $MacrosCode;
            $this->setHasMacros(!is_null($MacrosCode));
        }

        /  **
         * Devuelveelcódigodemacros
         * *
         * @return string | nulo
         *  /
        funciónpúblicagetMacrosCode() {
            devuelve$this->macrosCode;
        }

        /  **
         * Establecerelcertificadodemacros
         * *
         * @paramstring | null$Certificate
         *  /
        funciónpúblicasetMacrosCertificate($Certificate = null) {
            $this->macrosCertificate = $Certificado;
        }

        /  **
         * ¿Elproyectoestáfirmado ?
         * *
         * @return booleantrue | false
         *  /
        funciónpúblicahasMacrosCertificate() {
            volver!is_null($this->macrosCertificate);
        }

        /  **
         * Devolverelcertificadodemacros
         * *
         * @return string | nulo
         *  /
        funciónpúblicagetMacrosCertificate() {
            devuelve$this->macrosCertificate;
        }

        /  **
         * Eliminartodaslasmacros, certificadodehojadecálculo
         * *
         *  /
        funciónpúblicadiscardMacros() {
            $this->hasMacros         = false;
            $this->macrosCode        = null;
            $this->macrosCertificate = null;
        }

        /  **
         * establecerdatosXMLdelacinta
         * *
         *  /
        funciónpúblicasetRibbonXMLData($Target = null, $XMLData = null) {
            if (!is_null($Target) && !is_null($XMLData)) {
                $this->ribbonXMLData = array('target' => $Target, 'data' => $XMLData);
            }más {
                $this->ribbonXMLData = nulo;
            }
        }

        /  **
         * recuperardatosXMLdelacinta
         * *
         * cadenaderetorno | nulo | matriz
         *  /
        funciónpúblicagetRibbonXMLData($What = 'all') // necesitamos algunas constantes aquí ...
        {
            $ReturnData = nulo;
            $What       = strtolower($What);
            cambiar($What) {
                caso'todos' :
                $ReturnData = $this->ribbonXMLData;
                romper;
                caso'objetivo' :
                caso'datos':
                if (is_array($this->ribbonXMLData) && array_key_exists($What, $this->ribbonXMLData)) {
                    $ReturnData = $this->ribbonXMLData[$What];
                }
                romper;
            }

            return $ReturnData;
        }

        /  **
         * almacenarobjetosbinariosdelacinta(imágenes)
         * *
         *  /
        funciónpúblicasetRibbonBinObjects($BinObjectsNames = null, $BinObjectsData = null) {
            if (!is_null($BinObjectsNames) && !is_null($BinObjectsData)) {
                $this->ribbonBinObjects = array('nombres' => $BinObjectsNames, 'data' => $BinObjectsData);
            }más {
                $this->ribbonBinObjects = null;
            }
        }
        /  **
         * devolverlaextensióndeunnombredearchivo . Usointernoparaunadevolucióndellamadadearray_map(php < 5.3nomegustalafunciónlambda)
         * *
         *  /
        funciónprivadagetExtensionOnly($ThePath) {
            return pathinfo($ThePath, PATHINFO_EXTENSION);
        }

        /  **
         * recuperarobjetosdecintabinarios
         * *
         *  /
        funciónpúblicagetRibbonBinObjects($What = 'all') {
            $ReturnData = nulo;
            $What       = strtolower($What);
            cambiar($What) {
                caso'todos':
                devuelve$this->ribbonBinObjects;
                romper;
                decasos'nombres':
                caso'datos':
                if (is_array($this->ribbonBinObjects) && array_key_exists($What, $this->ribbonBinObjects)) {
                    $ReturnData = $this->ribbonBinObjects[$What];
                }
                romper;
                'tipos'demayúsculasyminúsculas:
                if (is_array($this->ribbonBinObjects) &&
                    array_key_exists('data', $this->ribbonBinObjects) && is_array($this->ribbonBinObjects['data'])) {
                    $tmpTypes   = array_keys($this->ribbonBinObjects['data']);
                    $ReturnData = array_unique(array_map(array($this, 'getExtensionOnly'), $tmpTypes));
                }más {
                    $ReturnData = array(); // la persona que llama quiere una matriz ... no nula si está vacía
                }
                romper;
            }
            return $ReturnData;
        }

        /  **
         * ¿EstelibrodetrabajotieneunaIUpersonalizada ?
         * *
         * @return booleantrue | false
         *  /
        funciónpúblicahasRibbon() {
            volver!is_null($this->ribbonXMLData);
        }

        /  **
         * ¿Estelibrodetrabajotieneunobjetoadicionalparalacinta ?
         * *
         * @return booleantrue | false
         *  /
        funciónpúblicahasRibbonBinObjects() {
            volver!is_null($this->ribbonBinObjects);
        }

        /  **
         * Compruebesiyaexisteunahojaconunnombredecódigoespecificado
         * *
         * @paramstring$pSheetCodeNameNombredelahojadetrabajoparaverificar
         * @return boolean
         *  /
        funciónpúblicasheetCodeNameExists($pSheetCodeName) {
            return ($this->getSheetByCodeName($pSheetCodeName)! == nulo);
        }

        /  **
         * Obtenerhojapornombredecódigo . Advertencia : ¡lahojanosiempretieneunnombreenclave!
         * *
         * @paramstring$pNameNombredelahoja
         * @return PHPExcel_Worksheet
         *  /
        funciónpúblicagetSheetByCodeName($pName = '') {
            $worksheetCount = count($this->workSheetCollection);
            para($i = 0;$i < $worksheetCount; ++$i) {
                if ($this->workSheetCollection[$i]->getCodeName() == $pName) {
                    devuelve$this->workSheetCollection[$i];
                }
            }

            volvernulo;
        }

        /  **
         * CrearunnuevoPHPExcelconunahojadetrabajo
         *  /
        funciónpública__construct() {
            $Este->IDunico           = uniqid();
            $Este->calculationEngine = nuevaPHPExcel_Calculation($presente);

            // Inicializa la colección de hojas de trabajo y agrega una hoja de trabajo
            $this->workSheetCollection   = array();
            $this->workSheetCollection[] = new PHPExcel_Worksheet($this);
            $this->activeSheetIndex      = 0;

            // Crear propiedades de documento
            $this->properties = new PHPExcel_DocumentProperties();

            // Crear seguridad de documentos
            $this->security = new PHPExcel_DocumentSecurity();

            // Establecer rangos con nombre
            $this->namedRanges = array();

            // Crear el supervisor cellXf
            $this->cellXfSupervisor = new PHPExcel_Style(verdadero);
            $this->cellXfSupervisor->bindParent($this);

            // Crea el estilo predeterminado
            $this->addCellXf(nuevoPHPExcel_Style);
            $this->addCellStyleXf(nuevoPHPExcel_Style);
        }

        /  **
         * Códigoparaejecutarcuandoestahojadetrabajonoestáconfigurada()
         * *
         *  /
        funciónpública__destruct() {
            $this->CalculateEngine = nulo;
            $this->disconnectWorksheets();
        }

        /  **
         * DesconectetodaslashojasdetrabajodeesteobjetodelibroPHPExcel,
         * típicamenteparaqueelobjetoPHPExcelpuedaserdesarmado
         * *
         *  /
        funciónpúblicadesconectaWorksheets() {
            $hojadetrabajo = nulo;
            foreach ($this->workSheetCollection as $k => &$worksheet) {
                $hojadetrabajo->disconnectCells();
                $this->workSheetCollection[$k] = nulo;
            }
            sinconfigurar($hojadetrabajo);
            $this->workSheetCollection = array();
        }

        /  **
         * Devuelvaelmotordecálculoparaestahojadetrabajo
         * *
         * @return PHPExcel_Calculation
         *  /
        funciónpúblicagetCalculationEngine() {
            devuelve$this->CalculateEngine;
        } // función getCellCacheController ()

        /  **
         * Obtenerpropiedades
         * *
         * @return PHPExcel_DocumentProperties
         *  /
        funciónpúblicagetProperties() {
            devuelve$this->propiedades;
        }

        /  **
         * Establecerpropiedades
         * *
         * @paramPHPExcel_DocumentProperties$pValue
         *  /
        funciónpúblicasetProperties(PHPExcel_DocumentProperties$pValue) {
            $this->propiedades = $pValue;
        }

        /  **
         * Obtengaseguridad
         * *
         * @return PHPExcel_DocumentSecurity
         *  /
        funciónpúblicagetSecurity() {
            devuelve$this->seguridad;
        }

        /  **
         * Establecerseguridad
         * *
         * @paramPHPExcel_DocumentSecurity$pValue
         *  /
        funciónpúblicasetSecurity(PHPExcel_DocumentSecurity$pValue) {
            $this->security = $pValue;
        }

        /  **
         * Obtenerhojaactiva
         * *
         * @return PHPExcel_Worksheet
         * *
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicagetActiveSheet() {
            devuelve$this->getSheet($this->activeSheetIndex);
        }

        /  **
         * Crearhojayagregarlaaestelibrodetrabajo
         * *
         * @paramint | null$iSheetIndexIndexdondedebeirlahoja(0, 1, ..., onuloparaelfinal )
         * @return PHPExcel_Worksheet
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicacreateSheet($iSheetIndex = null) {
            $newSheet = new PHPExcel_Worksheet($this);
            $this->addSheet($newSheet, $iSheetIndex);
            return $newSheet;
        }

        /  **
         * Compruebesiyaexisteunahojaconunnombreespecificado
         * *
         * @paramstring$pSheetNameNombredelahojadetrabajoparaverificar
         * @return boolean
         *  /
        funciónpúblicasheetNameExists($pSheetName) {
            return ($this->getSheetByName($pSheetName)! == null);
        }

        /  **
         * Agregarhoja
         * *
         * @paramPHPExcel_Worksheet$pSheet
         * @paramint | null$iSheetIndexIndexdondedebeirlahoja(0, 1, ..., onuloparaelfinal )
         * @return PHPExcel_Worksheet
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicaaddSheet(PHPExcel_Worksheet$pSheet, $iSheetIndex = null) {
            if ($this->sheetNameExists($pSheet->getTitle())) {
                lanzarunanuevaPHPExcel_Exception(
                    "El libro de trabajo ya contiene una hoja de trabajo llamada '{$pSheet->getTitle()}'. Cambie el nombre de esta hoja de trabajo primero" .
                );
            }

            if ($iSheetIndex === null) {
                if ($this->activeSheetIndex < 0) {
                    $this->activeSheetIndex = 0;
                }
                $this->workSheetCollection[] = $pSheet;
            }más{
                // Insertar la hoja en el índice solicitado
                array_splice(
                    $this->workSheetCollection,
                    $iSheetIndex,
                    0,
                    matriz($pSheet)
                );

                // Ajuste el índice de hoja activa si es necesario
                if ($this->activeSheetIndex >  = $iSheetIndex) {
                    ++$this->activeSheetIndex;
                }
            }

            if ($pSheet->getParent() === null) {
                $pSheet->rebindParent($this);
            }

            devuelve$pSheet;
        }

        /  **
         * Eliminarhojaporíndice
         * *
         * @paramint$pIndexÍndicedehojaactiva
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicaremoveSheetByIndex($pIndex = 0) {

            $numSheets = count($this->workSheetCollection);
            if ($pIndex > $numSheets - 1) {
                lanzarunanuevaPHPExcel_Exception(
                    "Intentó eliminar una hoja por el índice fuera de límites: {$pIndex}. El número real de hojas es {$numSheets}" .
                );
            }más{
                array_splice($this->workSheetCollection, $pIndex, 1);
            }
            // Ajuste el índice de hoja activa si es necesario
            if (($this->activeSheetIndex >  = $pIndex) &&
                ($pIndex > count($this->workSheetCollection) - 1)) {
                -$this->activeSheetIndex;
            }

        }

        /  **
         * Obtenerhojaporíndice
         * *
         * @paramint$pIndexÍndicedehoja
         * @return PHPExcel_Worksheet
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicagetSheet($pIndex = 0) {
            if (!isset($this->workSheetCollection[$pIndex])) {
                $numSheets = $this->getSheetCount();
                lanzarunanuevaPHPExcel_Exception(
                    "El índice de hoja solicitado: {$pIndex} está fuera de límites. El número real de hojas es {$numSheets}" .
                );
            }

            devuelve$this->workSheetCollection[$pIndex];
        }

        /  **
         * Obtengatodaslashojas
         * *
         * @return PHPExcel_Worksheet[]
         *  /
        funciónpúblicagetAllSheets() {
            devuelve$this->workSheetCollection;
        }

        /  **
         * Obtenerhojapornombre
         * *
         * @paramstring$pNameNombredelahoja
         * @return PHPExcel_Worksheet
         *  /
        funciónpúblicagetSheetByName($pName = '') {
            $worksheetCount = count($this->workSheetCollection);
            para($i = 0;$i < $worksheetCount; ++$i) {
                if ($this->workSheetCollection[$i]->getTitle() === $pName) {
                    devuelve$this->workSheetCollection[$i];
                }
            }

            volvernulo;
        }

        /  **
         * Obteneríndiceparahoja
         * *
         * @paramPHPExcel_Worksheet$pSheet
         * @return intÍndicedelahoja
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicagetIndex(PHPExcel_Worksheet$pSheet) {
            foreach ($this->workSheetCollection as $key => $value) {
                if ($value->getHashCode() == $pSheet->getHashCode()) {
                    volver$clave;
                }
            }

            lanzarunanuevaPHPExcel_Exception("La hoja no existe");
        }

        /  **
         * Estableceríndicedehojapornombredehoja .
         * *
         * @paramstring$sheetNameNombredelahojaparamodificarelíndicede
         * @paramint$newIndexNuevoíndiceparalahoja
         * @return intNuevoíndicedehoja
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicasetIndexByName($sheetName, $newIndex) {
            $oldIndex = $this->getIndex($this->getSheetByName($sheetName));
            $pSheet   = array_splice(
                $this->workSheetCollection,
                $oldIndex,
                1
            );
            array_splice(
                $this->workSheetCollection,
                $newIndex,
                0,
                $pSheet
            );
            return $newIndex;
        }

        /  **
         * Obtenerrecuentodehojas
         * *
         * @return int
         *  /
        funciónpúblicagetSheetCount() {
            cuentaderetorno($this->workSheetCollection);
        }

        /  **
         * Obteneríndicedehojaactiva
         * *
         * @return intÍndicedehojaactiva
         *  /
        funciónpúblicagetActiveSheetIndex() {
            devuelve$this->activeSheetIndex;
        }

        /  **
         * Estableceríndicedehojaactiva
         * *
         * @paramint$pIndexÍndicedehojaactiva
         * @throwsPHPExcel_Exception
         * @return PHPExcel_Worksheet
         *  /
        funciónpúblicasetActiveSheetIndex($pIndex = 0) {
            $numSheets = count($this->workSheetCollection);

            if ($pIndex > $numSheets - 1) {
                lanzarunanuevaPHPExcel_Exception(
                    "Intentó establecer una hoja activa por el índice fuera de límites: {$pIndex}. El número real de hojas es {$numSheets}" .
                );
            }más {
                $this->activeSheetIndex = $pIndex;
            }
            devuelve$this->getActiveSheet();
        }

        /  **
         * Estableceríndicedehojaactivapornombre
         * *
         * @paramstring$pTítulodelahojadevalor
         * @return PHPExcel_Worksheet
         * @throwsPHPExcel_Exception
         *  /
        funciónpúblicasetActiveSheetIndexByName($pValue = '') {
            if (($worksheet = $this->getSheetByName($pValue)) instanceof PHPExcel_Worksheet) {
                $this->setActiveSheetIndex($this->getIndex($hojadetrabajo));
                devolver$hojadetrabajo;
            }

            lanzarunanuevaPHPExcel_Exception('El libro de trabajo no contiene la hoja:' . $pValue);
        }

        /  **
         * Obtenernombresdehoja
         * *
         * @cadenaderetorno[]
         *  /
        funciónpúblicagetSheetNames() {
            $returnValue    = array();
            $worksheetCount = $this->getSheetCount();
            para($i = 0;$i < $worksheetCount; ++$i) {
                $returnValue[] = $this->getSheet($i)->getTitle();
            }

            return $returnValue;
        }

        /  **
         * Agregarhojaexterna
         * *
         * @paramPHPExcel_Worksheet$pSheetHojaexternaparaagregar
         * @paramint | null$iSheetIndexIndexdondedebeirlahoja(0, 1, ..., onuloparaelfinal )
         * @throwsPHPExcel_Exception
         * @return PHPExcel_Worksheet
         *  /
        funciónpúblicaaddExternalSheet(PHPExcel_Worksheet$pSheet, $iSheetIndex = null) {
            if ($this->sheetNameExists($pSheet->getTitle())) {
                lanzarunanuevaPHPExcel_Exception("El libro de trabajo ya contiene una hoja de trabajo llamada '{$pSheet->getTitle()}'. Cambie el nombre de la hoja externa primero.");
            }

            // cuenta cuántos cellXfs hay actualmente en este libro de trabajo, lo necesitaremos a continuación
            $countCellXfs = count($this->cellXfCollection);

            // copia todos los cellXfs compartidos del libro de trabajo externo y añádelos al actual
            foreach ($pSheet->getParent()->getCellXfCollection()como$cellXf) {
                $this->addCellXf(clone $cellXf);
            }

            // mover hoja a este libro de trabajo
            $pSheet->rebindParent($this);

            // actualiza el cellXfs
            foreach ($pSheet->getCellCollection(false)como$cellID) {
                $cell = $pSheet->getCell($cellID);
                $cell->setXfIndex($cell->getXfIndex()+$countCellXfs);
            }

            devuelve$this->addSheet($pSheet, $iSheetIndex);
        }

        /  **
         * Obtenerrangosconnombre
         * *
         * @return PHPExcel_NamedRange[]
         *  /
        funciónpúblicagetNamedRanges() {
            devuelve$this->namedRanges;
        }

        /  **
         * Agregarrangoconnombre
         * *
         * @paramPHPExcel_NamedRange$namedRange
         * @return boolean
         *  /
        funciónpúblicaaddNamedRange(PHPExcel_NamedRange$namedRange) {
            if ($namedRange->getScope() == null) {
                // alcance global
                $this->namedRanges[$namedRange->getName()] = $namedRange;
            }más {
                // ámbito local
                $this->namedRanges[$namedRange->getScope()->getTitle() . '!' . $namedRange->getName()] = $namedRange;
            }
            volververdadero;
        }

        /  **
         * Obtenerrangonombrado
         * *
         * @paramstring$namedRange
         * @paramPHPExcel_Worksheet | nulo$pSheetScope . Usarnuloparaalcanceglobal
         * @return PHPExcel_NamedRange | nulo
         *  /
        funciónpúblicagetNamedRange($namedRange, PHPExcel_Worksheet$pSheet = null) {
            $returnValue = null;

            if ($namedRange! = '' && ($namedRange! == null)) {
                // primero busca el nombre global definido
                if (isset($this->namedRanges[$namedRange])) {
                    $returnValue = $this->namedRanges[$namedRange];
                }

                // luego busca el nombre local definido (tiene prioridad sobre el nombre global definido si ambos nombres existen)
                if (($pSheet! == null) && isset($this->namedRanges[$pSheet->getTitle() . '!' . $namedRange])) {
                    $returnValue = $this->namedRanges[$pSheet->getTitle() . '!' . $namedRange];
                }
            }

            return $returnValue;
        }

        /  **
         * Eliminarrangoconnombre
         * *
         * @paramstring$namedRange
         * @paramPHPExcel_Worksheet | null$pSheetScope :
    }
}
devuelve$this;
}

    /  **
     * Obteneriteradordehojadetrabajo
     * *
     * @return PHPExcel_WorksheetIterator
     *  /
    funciónpúblicagetWorksheetIterator() {
        devolvernuevoPHPExcel_WorksheetIterator($this);
    }

    /  **
     * Copieellibrodetrabajo(! = clone !)
     * *
     * @return PHPExcel
     *  /
    copiadefunciónpública() {
        $copiado = clonar$esto;

        $worksheetCount = count($this->workSheetCollection);
        para($i = 0;$i < $worksheetCount; ++$i) {
            $this->workSheetCollection[$i] = $this->workSheetCollection[$i]->copy();
            $this->workSheetCollection[$i]->rebindParent($this);
        }

        return $copiado;
    }

    /  **
     * ImplementePHP__cloneparacrearunclonprofundo, nosolounacopiasuperficial .
     *  /
    funciónpública__clone() {
        foreach ($thiscomo$key => $val) {
            if (is_object($val) || (is_array($val))) {
                $this->{$key} = unserialize(serialize($val));
            }
        }
    }

    /  **
     * ObtengalacoleccióndelibrosdetrabajodecellXfs
     * *
     * @return PHPExcel_Style[]
     *  /
    funciónpúblicagetCellXfCollection() {
        devuelve$this->cellXfCollection;
    }

    /  **
     * ObtengacellXfporíndice
     * *
     * @paramint$pIndex
     * @return PHPExcel_Style
     *  /
    funciónpúblicagetCellXfByIndex($pIndex = 0) {
        devuelve$this->cellXfCollection[$pIndex];
    }

    /  **
     * ObtengacellXfporcódigohash
     * *
     * @paramstring$pValue
     * @return PHPExcel_Style | booleanFalsosinoseencuentraningunacoincidencia
     *  /
    funciónpúblicagetCellXfByHashCode($pValue = '') {
        foreach ($this->cellXfCollectioncomo$cellXf) {
            if ($cellXf->getHashCode() == $pValue) {
                devuelve$cellXf;
            }
        }
        devuelvefalso;
    }

    /  **
     * Verifiquesielestiloexisteenlacoleccióndeestilos
     * *
     * @paramPHPExcel_Style$pCellStyle
     * @return boolean
     *  /
    funciónpúblicacellXfExists($pCellStyle = null) {
        return in_array($pCellStyle, $this->cellXfCollection, true);
    }

    /  **
     * Obtenerestilopredeterminado
     * *
     * @return PHPExcel_Style
     * @throwsPHPExcel_Exception
     *  /
    funciónpúblicagetDefaultStyle() {
        if (isset($this->cellXfCollection[0])) {
            devuelve$this->cellXfCollection[0];
        }
        lanzarunanuevaPHPExcel_Exception('No se encontró un estilo predeterminado para este libro de trabajo');
    }

    /  **
     * AgregaruncellXfallibrodetrabajo
     * *
     * @paramPHPExcel_Style$style
     *  /
    funciónpúblicaaddCellXf(PHPExcel_Style$style) {
        $this->cellXfCollection[] = $estilo;
        $style->setIndex(cuenta($this->cellXfCollection) - 1);
    }

    /  **
     * EliminarcellXfporindex . Segarantizaquetodaslasceldasactualicensuíndicexf .
     * *
     * @paraminteger$pIndexIndextocellXf
     * @throwsPHPExcel_Exception
     *  /
    funciónpúblicaremoveCellXfByIndex($pIndex = 0) {
        if ($pIndex > count($this->cellXfCollection) - 1) {
            lanzarunanuevaPHPExcel_Exception("El índice CellXf está fuera de los límites");
        }más{
            // primero elimina el cellXf
            array_splice($this->cellXfCollection, $pIndex, 1);

            // luego actualiza los índices de cellXf para las celdas
            foreach ($this->workSheetCollection as $worksheet) {
                foreach ($hojadetrabajo->getCellCollection(false)como$cellID) {
                    $cell    = $hojadetrabajo->getCell($cellID);
                    $xfIndex = $cell->getXfIndex();
                    if ($xfIndex > $pIndex) {
                        // disminuye el índice xf en 1
                        $cell->setXfIndex($xfIndex - 1);
                    } elseif ($xfIndex == $pIndex) {
                        // establecido en el índice xf predeterminado 0
                        $cell->setXfIndex(0);
                    }
                }
            }
        }
    }

    /  **
     * ObtengaelsupervisordecellXf
     * *
     * @return PHPExcel_Style
     *  /
    funciónpúblicagetCellXfSupervisor() {
        devuelve$this->cellXfSupervisor;
    }

    /  **
     * ObtengalacoleccióndelibrosdetrabajodecellStyleXfs
     * *
     * @return PHPExcel_Style[]
     *  /
    funciónpúblicagetCellStyleXfCollection() {
        devuelve$this->cellStyleXfCollection;
    }

    /  **
     * ObtengacellStyleXfporíndice
     * *
     * @paraminteger$pIndexIndextocellXf
     * @return PHPExcel_Style
     *  /
    funciónpúblicagetCellStyleXfByIndex($pIndex = 0) {
        devuelve$this->cellStyleXfCollection[$pIndex];
    }

    /  **
     * ObtengacellStyleXfporcódigohash
     * *
     * @paramstring$pValue
     * @return PHPExcel_Style | booleanFalsosinoseencuentraningunacoincidencia
     *  /
    funciónpúblicagetCellStyleXfByHashCode($pValue = '') {
        foreach ($this->cellStyleXfCollectioncomo$cellStyleXf) {
            if ($cellStyleXf->getHashCode() == $pValue) {
                devolver$cellStyleXf;
            }
        }
        devuelvefalso;
    }

    /  **
     * AgregaruncellStyleXfallibrodetrabajo
     * *
     * @paramPHPExcel_Style$pStyle
     *  /
    funciónpúblicaaddCellStyleXf(PHPExcel_Style$pStyle) {
        $this->cellStyleXfCollection[] = $pStyle;
        $pStyle->setIndex(cuenta($this->cellStyleXfCollection) - 1);
    }

    /  **
     * EliminarcellStyleXfporindex
     * *
     * @paraminteger$pIndexIndextocellXf
     * @throwsPHPExcel_Exception
     *  /
    funciónpúblicaremoveCellStyleXfByIndex($pIndex = 0) {
        if ($pIndex > count($this->cellStyleXfCollection) - 1) {
            lanzarunanuevaPHPExcel_Exception("El índice CellStyleXf está fuera de los límites");
        }más{
            array_splice($this->cellStyleXfCollection, $pIndex, 1);
        }
    }

    /  **
     * EliminetodosloscellXfinnecesariosyluegoactualiceelxfIndexparatodaslasceldas
     * ycolumnasenellibrodetrabajo
     *  /
    funciónpúblicagarbageCollect() {
        // ¿cuántas referencias hay para cada cellXf?
        $countReferencesCellXf = array();
        foreach ($this->cellXfCollectioncomo$index => $cellXf) {
            $countReferencesCellXf[$index] = 0;
        }

        foreach ($this->getWorksheetIterator()como$sheet) {
            // de las celdas
            foreach ($sheet->getCellCollection(false)como$cellID) {
                $cell = $sheet->getCell($cellID);
                ++$countReferencesCellXf[$cell->getXfIndex()];
            }

            // desde las dimensiones de la fila
            foreach ($sheet->getRowDimensions()como$rowDimension) {
                if ($rowDimension->getXfIndex()! == null) {
                    ++$countReferencesCellXf[$rowDimension->getXfIndex()];
                }
            }

            // de las dimensiones de la columna
            foreach ($sheet->getColumnDimensions()como$columnDimension) {
                ++$countReferencesCellXf[$columnDimension->getXfIndex()];
            }
        }

        // elimina cellXfs sin referencias y crea mapeos para que podamos actualizar xfIndex
        // para todas las celdas y columnas
        $countNeededCellXfs = 0;
        $mapa               = matriz();
        foreach ($this->cellXfCollectioncomo$index => $cellXf) {
            if ($countReferencesCellXf[$index] > 0 || $index == 0) {
                // nunca debemos eliminar el primer cellXf
                ++$countNeededCellXfs;
            }más {
                unset($this->cellXfCollection[$index]);
            }
            $map[$index] = $countNeededCellXfs - 1;
        }
        $this->cellXfCollection = array_values($this->cellXfCollection);

        // actualiza el índice para todos los cellXfs
        foreach ($this->cellXfCollectioncomo$i => $cellXf) {
            $cellXf->setIndex($i);
        }

        // asegúrese de que siempre haya al menos un cellXf (debería haberlo)
        if (empty($this->cellXfCollection)) {
            $this->cellXfCollection[] = new PHPExcel_Style();
        }

        // actualiza el xfIndex para todas las celdas, dimensiones de fila, dimensiones de columna
        foreach ($this->getWorksheetIterator()como$sheet) {
            // para todas las celdas
            foreach ($sheet->getCellCollection(false)como$cellID) {
                $cell = $sheet->getCell($cellID);
                $cell->setXfIndex($map[$cell->getXfIndex()]);
            }

            // para todas las dimensiones de fila
            foreach ($sheet->getRowDimensions()como$rowDimension) {
                if ($rowDimension->getXfIndex()! == null) {
                    $rowDimension->setXfIndex($map[$rowDimension->getXfIndex()]);
                }
            }

            // para todas las dimensiones de columna
            foreach ($sheet->getColumnDimensions()como$columnDimension) {
                $columnDimension->setXfIndex($map[$columnDimension->getXfIndex()]);
            }

            // también hacemos recolección de basura para todas las hojas
            $sheet->garbageCollect();
        }
    }

    /  **
     * DevuelveelvalordeIDúnicoasignadoaestelibrodetrabajodehojadecálculo
     * *
     * @cadenaderetorno
     *  /
    funciónpúblicagetID() {
        devuelve$this->uniqueID;
    }
}
