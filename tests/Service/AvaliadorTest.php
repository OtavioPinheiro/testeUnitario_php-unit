<?php

namespace Alura\Leilao\Tests\Service;

use PHPUnit\Framework\TestCase;

use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    /** @var Avaliador */
    private $leiloeiro;

    protected function setUp(): void
    {
        $this->leiloeiro = new Avaliador();
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMaiorValorDeLances(Leilao $leilao): void
    {
        // Arrange - Given
        // Fornecido pelo Data Provider
        
        // Act - When
        $this->leiloeiro->avalia($leilao);
        
        $maiorValor = $this->leiloeiro->getMaiorValor();
        
        // Assert - Then
        $valorEsperado = 2500;
        
        self::assertEquals($valorEsperado, $maiorValor);
    }
    
    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveEncontrarOMenorValorDeLances(Leilao $leilao): void
    {
        // Arrange - Given
        // Fornecido pelo Data Provider
        
        // Act - When
        $this->leiloeiro->avalia($leilao);
        
        $menorValor = $this->leiloeiro->getMenorValor();
        
        // Assert - Then
        $valorEsperado = 1700;
        
        self::assertEquals($valorEsperado, $menorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testAvaliadorDeveBuscarOsTresMaioresLances(Leilao $leilao): void
    {
        // Arrange - Given
        // Fornecido pelo Data Provider
        
        // Act - When
        $this->leiloeiro->avalia($leilao);
        
        $maioresLances = $this->leiloeiro->getMaioresLances();
        
        // Assert - Then
        static::assertCount(3, $maioresLances);
        static::assertEquals(2500, $maioresLances[0]->getValor());
        static::assertEquals(2200, $maioresLances[1]->getValor());
        static::assertEquals(2000, $maioresLances[2]->getValor());
    }

    public function testLeilaoVazioNaoPodeSerAvaliado(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Não é possível avaliar um leilão vazio');
        $leilao = new Leilao('Fusca Azul');
        $this->leiloeiro->avalia($leilao);
    }

    public function testLeilaoFinalizadoNaoPodeSerAvaliado(): void
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('Leilão já finalizado');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->recebeLance(new Lance(new Usuario('Teste'), 2000));
        $leilao->finaliza();
        
        $this->leiloeiro->avalia($leilao);
    }

    public static function leilaoEmOrdemCrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');
        
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $jose = new Usuario('Jose');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 1700));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($jose, 2200));
        $leilao->recebeLance(new Lance($maria, 2500));

        return [[$leilao]];
    }

    public static function leilaoEmOrdemDecrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');
        
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $jose = new Usuario('Jose');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($jose, 2200));
        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($ana, 1700));

        return [[$leilao]];
    }

    public static function leilaoEmOrdemAleatoria(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');
        
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $jose = new Usuario('Jose');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($jose, 2200));
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($ana, 1700));
        $leilao->recebeLance(new Lance($joao, 2000));

        return [[$leilao]];
    }
}