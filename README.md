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
