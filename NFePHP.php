<?php
//namespace CI;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//require_once 'autoload.php';

use NFePHP\Extras\Danfe;
use NFePHP\Extras\Danfce;
use NFePHP\Common\Files\FilesFolders;

/**
 * Description of NFePHP
 *
 * @author Marcos Alexandre de Oliveira
 */
class NFePHP {

    //put your code here

    private $filePDF = NULL;
    private $filePathXML = NULL;

    /**
     * orientação da DANFE
     * P-Retrato ou
     * L-Paisagem
     * @var string
     */
    private $orientacao = 'P';

    /**
     * formato do papel
     * @var string
     */
    private $papel = 'A4';

    /**
     * destino do arquivo pdf
     * I-borwser,
     * S-retorna o arquivo,
     * D-força download,
     * F-salva em arquivo local
     * @var string
     */
    private $destino = 'I';

    /**
     * diretorio para salvar o pdf com a opção de destino = F
     * @var string
     */
    private $pdfDir = '';

    /**
     * path para logomarca em jpg
     * @var string
     */
    protected $logomarca = '';

    public function __construct($config = array()) {
        if (!empty($config)) {
            $this->initialize($config);
        }
    }

    /**
     * 
     * @param array $config
     */
    function initialize($config = array()) {
        foreach ($config as $key => $value) {
            if(isset($this->$key)){
                $this->$key = $value;
            }
        }
    }
    /**
     * 
     * @param file $docXML
     * @return \NFePHP
     * @throws Exception
     */
    public function geraDanfe($docXML = NULL) {
        try {
            if (is_null($docXML) || empty($docXML)) {
                $docXML = FilesFolders::readFile($this->filePathXML);
            }
            $this->logomarca = ($this->logomarca)?$this->logomarca:base_url('imagem/nfe.png');
            $danfe = new Danfe(
                    $docXML, $this->orientacao, $this->papel, $this->logomarca, $this->destino, $this->pdfDir
            );
            $id = $danfe->montaDANFE();
            $this->filePDF = $danfe->printDANFE($id . '.pdf', $this->destino);
            return $this;
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }
    /**
     * 
     * @param file $docXML
     * @return \NFePHP
     * @throws Exception
     */
    public function geraDanfce($docXML = NULL) {
        try{
            if (is_null($docXML) || empty($docXML)) {
                $docXML = FilesFolders::readFile($this->filePathXML);
            }
            $this->logomarca = ($this->logomarca)?$this->logomarca:base_url('imagem/nfce.png');
            $danfce = new Danfce($docXML, $this->logomarca, 2);
            $id = $danfce->montaDANFE(FALSE);
            $this->filePDF = $danfce->printDANFE('pdf',$id.'.pdf', $this->destino);
            return $this;
        } catch (Exception $ex){
            throw new Exception($ex->getMessage());
            
        }
    }
    /**
     * 
     * @param file $docXML
     * @param int $modelo
     * @return \Exception
     */
    public function geraDaNfeNfce($docXML = NULL, $modelo=55){
        try{
            if (is_null($docXML) || empty($docXML)) {
                $docXML = FilesFolders::readFile($this->filePathXML);
            }
            //NF-e
            if($modelo==55){
                return $this->geraDanfe($docXML);
            }
            //NFC-e
            else{
                return $this->geraDanfce($docXML);
            }
        } catch (Exception $ex){
            return $ex;
        }
    }

    public function getFilePDF() {
        return $this->filePDF;
    }

    public function setFilePathXML($filePathXML) {
        $this->filePathXML = $filePathXML;
    }

    public function setOrientacao($orientacao) {
        $this->orientacao = $orientacao;
    }

    public function setPapel($papel) {
        $this->papel = $papel;
    }

    public function setDestino($destino) {
        $this->destino = $destino;
    }

    public function setPdfDir($pdfDir) {
        $this->pdfDir = $pdfDir;
    }

    public function setLogomarca($logomarca) {
        $this->logomarca = $logomarca;
    }

}
