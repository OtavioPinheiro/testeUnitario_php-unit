# PHP e TDD: testes com PHPUnit
Curso da Alura ensinando a utilizar o PHPUnit para escrever e executar testes unitários.

## Dependências
Se você estiver usando o PHP 8.1 ou superior, recomendamos que você utilize o seguinte comando:

```bash
composer require --dev phpunit/phpunit ^10
```

Isso se deve ao fato de que o PHPUnit 8 não é compatível com o PHP 8 ou versões superiores.

# Sumário
1. [TDD](#tdd)
2. [O que é PHP Unit?](#o-que-é-php-unit)
3. [Data Providers](#data-providers)
4. [Fixtures](#fixtures)
5. [Arquivo de configuração do PHPUnit](#arquivo-de-configuração-do-phpunit)

# TDD
**TDD**, ou Desenvolvimento Orientado a Testes (em inglês, _Test-Driven Development_), é uma prática de desenvolvimento de software onde você escreve os testes antes de escrever o código da funcionalidade em si. Parece contraintuitivo à primeira vista, mas traz muitos benefícios.

O **TDD** segue um ciclo chamado de "_Red, Green, Refactor_" (Vermelho, Verde, Refatorar):

***Red (Vermelho)***: Você escreve um pequeno teste automatizado para uma funcionalidade que você ainda não implementou. Como o código da funcionalidade não existe, o teste inevitavelmente falha (fica "vermelho"). O objetivo aqui é definir exatamente o que a funcionalidade deve fazer.

***Green (Verde)***: Você escreve o código mínimo necessário para fazer o teste passar (ficar "verde"). Neste passo, a preocupação principal é satisfazer o teste, mesmo que o código não esteja perfeito. A ideia é ter uma prova concreta de que a funcionalidade básica está funcionando.

***Refactor (Refatorar)***: Com o teste passando, você agora tem a liberdade de melhorar a estrutura e a organização do código, sem medo de quebrar a funcionalidade. Os testes garantem que as mudanças não introduzam novos erros. Você pode limpar o código, remover duplicações e torná-lo mais legível e eficiente.

**Exemplo simples:**

Imagine que você precisa criar uma função que soma dois números. Em TDD, você faria assim:

- _Red_: Escreva um teste que verifica se a soma de 2 e 3 é igual a 5. Como a função de soma não existe, o teste falha.

- _Green_: Escreva a função de soma:

```php
<?php

function somar(int $a, int $b): int {
    return $a + $b;
}

?>
```
O teste agora passa.

- _Refactor_: Se necessário, você pode melhorar a função, por exemplo, adicionando tratamento para entradas inválidas ou melhorando a performance. Como você tem o teste, pode fazer essas mudanças com confiança.

### Benefícios do TDD:
- **Código mais limpo e organizado:** O ciclo _Red-Green-Refactor_ força você a pensar no design do código antes de implementá-lo, resultando em um código mais modular e fácil de manter.

- **Menos bugs:** Escrever testes antes do código ajuda a identificar erros logo no início do desenvolvimento, tornando a correção mais fácil e barata.

- **Maior confiança nas mudanças:** Com uma boa cobertura de testes, você pode fazer alterações no código com mais segurança, sabendo que os testes irão alertar se algo quebrar.

- **Documentação viva:** Os testes servem como uma forma de documentação executável, mostrando como o código deve se comportar.

- **Melhor design:** O TDD incentiva a criação de código com alta coesão e baixo acoplamento, o que facilita a reutilização e a testabilidade.

Embora o TDD possa exigir um investimento inicial de tempo para aprender e aplicar, os benefícios a longo prazo, em termos de qualidade do código, redução de bugs e facilidade de manutenção, geralmente superam o esforço inicial.

[Sumário](#sumário)

# O que é PHP Unit?
PHPUnit é um framework popular para testes unitários em PHP. Ele permite que desenvolvedores escrevam testes automatizados para garantir que unidades individuais de código (como funções, métodos ou classes) funcionem conforme o esperado. É uma ferramenta essencial para praticar TDD (Desenvolvimento Orientado a Testes) e para manter a qualidade do código em projetos PHP.

## O que são Testes Unitários?
Antes de falar especificamente sobre o **PHPUnit**, é importante entender o conceito de testes unitários. Eles se concentram em testar pequenas partes isoladas do código, verificando se cada unidade executa sua função corretamente, independentemente do resto do sistema. Isso ajuda a identificar erros logo no início do desenvolvimento, tornando a correção mais fácil e rápida.

## Como o PHPUnit Funciona?
O PHPUnit oferece uma estrutura para escrever e executar testes. Os testes são escritos em classes que herdam da classe `PHPUnit\Framework\TestCase`. Dentro dessas classes, você define métodos de teste que contêm asserções (_assertions_). As asserções verificam se um determinado resultado corresponde ao esperado.

**Exemplo Básico:**

Imagine que você tem uma função simples que soma dois números:

```php
<?php
function somar(int $a, int $b): int {
    return $a + $b;
}
?>
```

Um teste unitário para essa função usando PHPUnit seria:

```php
<?php
use PHPUnit\Framework\TestCase;

class SomarTest extends TestCase {
    public function testSomarNumerosPositivos() {
        $this->assertEquals(5, somar(2, 3));
    }

    public function testSomarNumeroComZero() {
        $this->assertEquals(2, somar(2, 0));
    }

    public function testSomarNumerosNegativos() {
        $this->assertEquals(-5, somar(-2, -3));
    }
}
?>
```

**Neste exemplo:**

*   `SomarTest` é a classe de teste, que herda de `TestCase`.
*   `testSomarNumerosPositivos`, `testSomarNumeroComZero` e `testSomarNumerosNegativos` são os métodos de teste. Cada método testa um cenário diferente.
*   `$this->assertEquals(5, somar(2, 3))` é uma asserção. Ela verifica se o resultado da chamada `somar(2, 3)` é igual a 5.

## Executando Testes:
Para executar os testes, você geralmente usa o executável `phpunit` a partir da linha de comando. O PHPUnit procura por arquivos de teste (normalmente com sufixo `Test.php`) e executa os métodos de teste dentro deles. Ele então apresenta um relatório mostrando quais testes passaram e quais falharam.

### Recursos e Asserções do PHPUnit:
O PHPUnit oferece uma vasta gama de recursos e asserções, incluindo:

*   **Asserções:** `assertEquals()`, `assertSame()`, `assertTrue()`, `assertFalse()`, `assertNull()`, `assertGreaterThan()`, `assertLessThan()`, `expectException()`, entre muitas outras.
*   **Fixtures:** Mecanismos para configurar o ambiente de teste antes da execução dos testes (`setUp()`) e limpar depois (`tearDown()`).
*   **Data Providers:** Permitem executar o mesmo teste com diferentes conjuntos de dados.
*   **Mocks e Stubs:** Facilitam o isolamento da unidade em teste, simulando dependências externas.
*   **Cobertura de Código:** Permite gerar relatórios de cobertura, mostrando quais partes do código foram executadas pelos testes.

### Benefícios do Uso do PHPUnit:
*   **Detecção precoce de erros:** Ajuda a encontrar erros no código logo no início do desenvolvimento.
*   **Melhora a qualidade do código:** Incentiva a escrita de código mais modular, testável e manutenível.
*   **Facilita a refatoração:** Permite fazer alterações no código com mais confiança, sabendo que os testes irão alertar sobre possíveis regressões.
*   **Documentação viva:** Os testes servem como uma forma de documentação executável, mostrando como o código deve se comportar.
*   **Integração contínua:** Facilita a integração com ferramentas de integração contínua (CI), automatizando a execução dos testes em cada commit.

Em resumo, o **PHPUnit** é uma ferramenta poderosa e essencial para qualquer desenvolvedor PHP que se preocupa com a qualidade do código e deseja adotar boas práticas de desenvolvimento, como o TDD. Ele fornece uma estrutura robusta e flexível para escrever e executar testes unitários, contribuindo para a criação de software mais confiável e manutenível.

[Sumário](#sumário)

# Data Providers
Em testes unitários com **PHPUnit**, um _Data Provider_ é uma funcionalidade que permite fornecer múltiplos conjuntos de dados para um único método de teste. Isso é útil para evitar a duplicação de código e garantir que um mesmo método de teste seja executado com diversas entradas, ajudando a aumentar a cobertura de testes de maneira eficiente.

## Por que usar Data Providers?
1. **Evitar Redundância:** Com um Data Provider, você elimina a necessidade de escrever múltiplos métodos de teste para casos semelhantes.
2. **Organização e Legibilidade:** Os dados de entrada e os testes são separados, deixando o código mais limpo e compreensível.
3. **Automação:** Facilita a execução de um conjunto de testes variados, sem necessidade de alterar o método de teste principal.

## Como funciona?
Um _Data Provider_ é simplesmente um método que retorna um _array_ ou um iterável contendo os conjuntos de dados que serão usados como parâmetros do método de teste. Ele é associado ao método de teste com a anotação `@dataProvider`.

## Sintaxe Básica
Abaixo está uma estrutura típica de um _Data Provider_:

```php
class ExampleTest extends \PHPUnit\Framework\TestCase
{
    /**
     * Teste que utiliza o Data Provider.
     *
     * @dataProvider dataProviderMethod
     */
    public function testAddition($a, $b, $expected)
    {
        $this->assertEquals($expected, $a + $b);
    }

    /**
     * Data Provider que fornece os dados para o teste.
     */
    public function dataProviderMethod()
    {
        return [
            'case 1: two positive numbers' => [2, 3, 5],
            'case 2: positive and negative' => [5, -2, 3],
            'case 3: two negatives' => [-2, -3, -5],
        ];
    }
}
```

**Explicação:**
1. O método `testAddition` é o método de teste que será executado várias vezes com diferentes conjuntos de dados fornecidos pelo `dataProviderMethod`.
2. O método `dataProviderMethod` retorna um _array_ onde cada elemento representa um conjunto de parâmetros para o teste.
3. As chaves descritivas no _array_ (`'case 1: ...'`) ajudam a identificar os casos nos relatórios de testes.

### Regras para Data Providers
1. **Visibilidade do Método:** O _Data Provider_ deve ser um método público. A partir da versão 10 do **PHPUnit** (PHPUnit 10) o método de _Data Provider_ deve ser declarado como `public` e `static`, ou seja, o método data provider utilizado deve ser um método público e estático. [PHPUnit - Data Providers](https://docs.phpunit.de/en/10.5/writing-tests-for-phpunit.html#data-providers).

2. **Assinatura:** O método de teste deve ter parâmetros que correspondam à estrutura dos dados fornecidos pelo _Data Provider_.

3. **Retorno do Data Provider:** Deve retornar um *array* ou um iterável onde cada elemento é um *array* com os valores que serão passados ao teste.

**Exemplo Avançado com Classes e Objetos**
Você também pode usar objetos em um _Data Provider_:

```php
class UserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider userProvider
     */
    public function testUserAge($user, $expectedAge)
    {
        $this->assertEquals($expectedAge, $user->getAge());
    }

    public function userProvider()
    {
        return [
            [new User('Alice', 30), 30],
            [new User('Bob', 25), 25],
        ];
    }
}
```

**Exemplo com Iteradores**
Para conjuntos de dados muito grandes, usar iteradores pode ser mais eficiente do que _arrays_:

```php
class LargeDataTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider largeDataProvider
     */
    public function testLargeData($value, $expected)
    {
        $this->assertEquals($expected, $value * 2);
    }

    public function largeDataProvider()
    {
        yield [1, 2];
        yield [2, 4];
        yield [3, 6];
    }
}
```

## Benefícios no Uso de Data Providers
- **Reduz código duplicado:** Permite centralizar todos os cenários de teste em um único local.
- **Escalabilidade:** Facilita a adição de novos cenários de teste.
- **Legibilidade:** Mantém os métodos de teste enxutos e focados em sua lógica.
- **Desempenho:** Pode usar iteradores para lidar com grandes volumes de dados.

## Dicas ao Usar Data Providers
1. **Nomeação Clara:** Dê nomes descritivos aos casos no array retornado para identificar facilmente os cenários.
2. **Separação de Preocupações:** Mantenha o Data Provider simples e separado da lógica de teste.
3. **Reutilização:** Use Data Providers compartilhados para métodos de teste relacionados.

## Conclusão
Os _Data Providers_ são uma ferramenta poderosa no **PHPUnit** para testar diversas condições e entradas sem duplicar código. Eles são especialmente úteis em cenários complexos ou ao testar funções que aceitam múltiplos valores possíveis. Com a separação clara entre os dados e a lógica de teste, seu código de teste se torna mais limpo, organizado e fácil de manter.

[Sumário](#sumário)

# Fixtures
As **fixtures** no PHPUnit são um conceito fundamental para a criação de testes confiáveis e bem estruturados. Elas representam o estado inicial necessário para executar um teste, ou seja, **configuram o ambiente para que o teste tenha tudo o que precisa para ser executado corretamente.**

O PHPUnit oferece métodos especiais para configurar e limpar as _fixtures_ antes e depois da execução de um teste. Esses métodos são especialmente úteis para configurar dependências, inicializar dados e garantir que o ambiente seja restaurado ao estado original após a execução dos testes.

---

### **Por que usar Fixtures?**
1. **Configuração Consistente:** Garantem que cada teste inicie com as mesmas condições, evitando interferências entre eles.
2. **Reutilização de Código:** Evitam duplicação ao configurar o mesmo ambiente para vários testes.
3. **Confiabilidade:** Garantem que cada teste seja isolado e independente dos outros.

---

### **Principais Métodos de Fixture no PHPUnit**
O PHPUnit fornece quatro métodos principais para gerenciar as fixtures:

1. **`setUp()`**
   - É executado antes de cada método de teste.
   - Usado para configurar o estado necessário para cada teste.
   - Geralmente inicializa objetos e variáveis.

2. **`tearDown()`**
   - É executado após cada método de teste.
   - Usado para limpar ou desfazer alterações feitas durante o teste.

3. **`setUpBeforeClass()`**
   - Executado uma vez antes de todos os testes da classe.
   - Usado para configurar recursos compartilhados entre os testes.

4. **`tearDownAfterClass()`**
   - Executado uma vez após todos os testes da classe.
   - Usado para liberar recursos compartilhados.

---

### **Exemplo Básico de Fixture**

```php
class UserTest extends \PHPUnit\Framework\TestCase
{
    private $user;

    /**
     * Configuração inicial antes de cada teste.
     */
    protected function setUp(): void
    {
        $this->user = new User('Alice', 'alice@example.com');
    }

    /**
     * Limpeza após cada teste.
     */
    protected function tearDown(): void
    {
        unset($this->user);
    }

    /**
     * Teste de exemplo usando a fixture.
     */
    public function testUserName()
    {
        $this->assertEquals('Alice', $this->user->getName());
    }

    public function testUserEmail()
    {
        $this->assertEquals('alice@example.com', $this->user->getEmail());
    }
}
```

#### **Explicação:**
1. O método `setUp()` inicializa o objeto `User` antes de cada teste.
2. O método `tearDown()` desfaz a inicialização, garantindo que o estado seja limpo.
3. Os testes `testUserName` e `testUserEmail` reutilizam a configuração criada no `setUp()`.

---

### **Exemplo com Recursos Compartilhados**
Para casos onde o custo de criar ou liberar recursos é alto (como conexões com banco de dados ou arquivos), use `setUpBeforeClass()` e `tearDownAfterClass()`.

```php
class DatabaseTest extends \PHPUnit\Framework\TestCase
{
    protected static $dbConnection;

    /**
     * Configuração única antes de todos os testes.
     */
    public static function setUpBeforeClass(): void
    {
        self::$dbConnection = new DatabaseConnection('localhost', 'testdb', 'user', 'password');
    }

    /**
     * Limpeza única após todos os testes.
     */
    public static function tearDownAfterClass(): void
    {
        self::$dbConnection->close();
        self::$dbConnection = null;
    }

    public function testDatabaseConnection()
    {
        $this->assertTrue(self::$dbConnection->isConnected());
    }
}
```

#### **Explicação:**
1. `setUpBeforeClass()` cria uma conexão com o banco de dados uma única vez antes de todos os testes.
2. `tearDownAfterClass()` fecha a conexão após todos os testes, liberando recursos.

---

### **Boas Práticas ao Usar Fixtures**
1. **Evite Dependências Entre Testes:**
   - Cada teste deve ser independente, e as fixtures garantem isso ao resetar o estado inicial.

2. **Não Use Recursos Reais Sempre:**
   - Para dependências como bancos de dados ou APIs externas, considere usar **mocks** ou **stubs** para reduzir o tempo de execução dos testes e evitar efeitos colaterais.

3. **Limpeza Adequada:**
   - Sempre limpe os recursos criados em `setUp()` ou `setUpBeforeClass()` para evitar interferências.

4. **Mantenha o `setUp()` Simples:**
   - Configure apenas o que é necessário para os testes; evite lógica complexa.

---

### **Conclusão**
As **fixtures** no PHPUnit são uma ferramenta poderosa para configurar e gerenciar o estado de testes de forma eficiente. Elas permitem criar testes mais robustos, organizados e confiáveis, garantindo que cada teste seja executado em um ambiente previsível e controlado. Ao utilizar os métodos fornecidos (`setUp`, `tearDown`, etc.), você pode otimizar seus testes e melhorar a qualidade geral do código.

[PHPUnit - Fixtures](https://docs.phpunit.de/en/8.5/fixtures.html)

---

### Comparação de _Fixtures_ com outras linguagens
Em outras linguagens também temos as _fixtures_ porém implementadas de formas diferentes.

| Linguagem       | Framework            | Métodos de Configuração/Fixtures                                      | Descrição                                                                                   | Exemplo de Uso                                                                                     |
|------------------|----------------------|------------------------------------------------------------------------|---------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------|
| **PHP**         | PHPUnit              | `setUp`, `tearDown`, `setUpBeforeClass`, `tearDownAfterClass`          | Métodos usados para configurar e limpar o ambiente antes e depois de testes individuais ou de toda a classe. | `protected function setUp(): void { $this->user = new User(); }`                                   |
| **Java**        | JUnit                | `@Before`, `@After`, `@BeforeClass`, `@AfterClass`                    | Anotações para métodos que inicializam ou limpam o estado antes/depois de cada teste ou da classe inteira. | `@Before public void setUp() { user = new User(); }`                                               |
| **Python**      | unittest             | `setUp`, `tearDown`, `setUpClass`, `tearDownClass`                    | Métodos de inicialização e limpeza para configurar o estado antes/depois de cada teste ou classe. | `def setUp(self): self.user = User()`                                                              |
| **JavaScript**  | Jest                 | `beforeEach`, `afterEach`, `beforeAll`, `afterAll`                    | Ganchos que executam funções de configuração e limpeza antes/depois de cada teste ou de todos os testes. | `beforeEach(() => { user = new User(); });`                                                        |
| **C#**          | NUnit                | `SetUp`, `TearDown`, `OneTimeSetUp`, `OneTimeTearDown`                | Métodos que configuram ou limpam o ambiente antes/depois de cada teste ou de toda a classe. | `[SetUp] public void SetUp() { user = new User(); }`                                               |
| **Python**      | pytest               | `@pytest.fixture`, `yield`                                            | Decoradores e geradores para criar fixtures reutilizáveis e limpar após o teste.            | `@pytest.fixture def user(): return User()`                                                        |
| **JavaScript**  | Mocha                | `before`, `after`, `beforeEach`, `afterEach`                          | Ganchos para executar lógica de configuração e limpeza antes/depois de cada teste ou de todos os testes. | `before(() => { user = new User(); });`                                                            |

[Sumário](#sumário)

# Arquivo de configuração do PHPUnit
O arquivo `phpunit.xml` ou `phpunit.xml.dist` é um componente essencial para configurar testes no PHPUnit. Ele define opções como diretórios de testes, configurações de cobertura de código, valores de variáveis de ambiente e outras definições que afetam a execução dos testes.

---

## Estrutura Geral de um Arquivo `phpunit.xml`
Um exemplo básico de arquivo de configuração é:

```xml
<phpunit bootstrap="tests/bootstrap.php" colors="true">
    <testsuites>
        <testsuite name="Default Suite">
            <directory>tests</directory>
        </testsuite>
    </testsuites>

    <coverage processUncoveredFiles="true">
        <include>
            <directory>src</directory>
        </include>
    </coverage>

    <php>
        <env name="APP_ENV" value="testing"/>
        <env name="DB_HOST" value="localhost"/>
    </php>
</phpunit>
```

---

### Diferenças entre PHPUnit 8.1 e 10.5

#### 1. **Estrutura Geral do XML**
   - **PHPUnit 8.1:** 
     - O suporte para XML foi mais flexível, permitindo valores adicionais que não seguiam as restrições de esquema.
     - Diretivas como `colors="true"` ainda eram comumente usadas para habilitar cores no terminal.
   - **PHPUnit 10.5:** 
     - Introduziu uma validação mais rigorosa no arquivo `phpunit.xml` com base em um esquema XSD. Configurações inválidas ou não reconhecidas causam erros.
     - Algumas opções, como `colors`, foram descontinuadas e substituídas por configurações no terminal ou no comando de execução.

#### 2. **Estrutura de Suites**
   - **PHPUnit 8.1:** Suportes flexíveis para diretórios com `<directory>` diretamente dentro de `<testsuite>`.
   - **PHPUnit 10.5:** Requere uma organização mais detalhada e suporte a novos atributos para facilitar execução granular.

**Exemplo:**
   - **PHPUnit 8.1**

     ```xml
     <testsuite name="Default Suite">
         <directory>tests</directory>
     </testsuite>
     ```

   - **PHPUnit 10.5**

     ```xml
     <testsuites>
         <testsuite name="Unit Tests">
             <directory suffix="Test.php">tests/Unit</directory>
         </testsuite>
     </testsuites>
     ```

#### 3. **Cobertura de Código**
   - **PHPUnit 8.1:** Simples, com `<coverage>` definido diretamente.
   - **PHPUnit 10.5:** Adotou uma estrutura mais detalhada e novas opções para cobertura de código.

     ```xml
     <coverage>
         <include>
             <directory>src</directory>
         </include>
         <report>
             <text outputFile="coverage.txt"/>
             <html outputDirectory="build/coverage"/>
         </report>
     </coverage>
     ```

#### 4. **Novas Tags no PHPUnit 10.5**
   - Introdução de `<cache>` para gerenciar cache de testes.

     ```xml
     <cache directory=".phpunit/cache"/>
     ```

   - Novos atributos como `failOnEmptyTestSuite` para evitar falsos positivos quando uma suite de testes está vazia.

#### 5. **Comportamento Deprecado no PHPUnit 10.5**
   - Atributos como `processIsolation` e `colors` foram descontinuados ou movidos para outras formas de configuração.
   - Configurações inválidas no XML resultam em erro imediato.

---

**Exemplo Comparativo de Arquivo Completo:**

**PHPUnit 8.1**

```xml
<phpunit bootstrap="tests/bootstrap.php" colors="true">
    <testsuites>
        <testsuite name="Default Suite">
            <directory>tests</directory>
        </testsuite>
    </testsuites>
</phpunit>
```

**PHPUnit 10.5**

```xml
<phpunit bootstrap="tests/bootstrap.php" failOnEmptyTestSuite="true">
    <testsuites>
        <testsuite name="Unit Tests">
            <directory suffix="Test.php">tests/Unit</directory>
        </testsuite>
    </testsuites>

    <coverage>
        <include>
            <directory>src</directory>
        </include>
        <report>
            <text outputFile="coverage.txt"/>
            <html outputDirectory="build/coverage"/>
        </report>
    </coverage>

    <cache directory=".phpunit/cache"/>
</phpunit>
```

---

### Conclusão
As mudanças entre o PHPUnit 8.1 e 10.5 refletem a evolução em termos de rigor e padronização. O PHPUnit 10.5 introduziu melhorias significativas na validação de configuração e suporte a novas funcionalidades, mas exige mais cuidado ao configurar o arquivo `phpunit.xml`.

[Sumário](#sumário)
