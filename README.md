# NFePHP-CodeIgniter-OldVersion
Implantando NFePHP em versões mais antigas do Codeigniter

Obs.: Foi Testado na versão 2.1

## Uso
Transfira todos esses diretórios e arquivos para dentro de libraries e em index.php principal do Codeigniter add a seguinte linha
```
 require_once APPPATH.'libraries/autoload.php';
```
A Linha acima foi adicionada antes de chamar o arqivo CodeIgniter.php.

Para chamar a class pode ser dentro do construct do controller
```
 $this->load->library('NFePHP');
```
Ou declarando no arquivo autoload dentro de config
```
 $autoload['libraries'] = array('NFePHP');
```
## Referência

https://github.com/0l1v31r4/NFePHP-CodeIgniter
