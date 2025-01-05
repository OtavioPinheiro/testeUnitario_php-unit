<?php

namespace Alura\Leilao\Tests\Service;

use PHPUnit\Framework\TestCase;

use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente(): void
    {
        // Arrange - Given
        $leilao = $this->leilaoEmOrdemCrescente();
        
        // Act - When
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $maiorValor = $leiloeiro->getMaiorValor();
        
        // Assert - Then
        $valorEsperado = 2500;
        
        self::assertEquals($valorEsperado, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente(): void
    {
        // Arrange - Given
        $leilao = $this->leilaoEmOrdemDecrescente();
        
        // Act - When
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $maiorValor = $leiloeiro->getMaiorValor();
        
        // Assert - Then
        $valorEsperado = 2500;
        
        self::assertEquals($valorEsperado, $maiorValor);
    }
    
    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemCrescente(): void
    {
        // Arrange - Given
        $leilao = $this->leilaoEmOrdemCrescente();
        
        // Act - When
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $menorValor = $leiloeiro->getMenorValor();
        
        // Assert - Then
        $valorEsperado = 1700;
        
        self::assertEquals($valorEsperado, $menorValor);
    }

    public function testAvaliadorDeveEncontrarOMenorValorDeLancesEmOrdemDecrescente(): void
    {
        // Arrange - Given
        $leilao = $this->leilaoEmOrdemDecrescente();
        
        // Act - When
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $menorValor = $leiloeiro->getMenorValor();
        
        // Assert - Then
        $valorEsperado = 1700;
        
        self::assertEquals($valorEsperado, $menorValor);
    }

    public function testAvaliadorDeveBuscarOsTresMaioresLances(): void
    {
        // Arrange - Given
        $leilao = new Leilao('Fiat 147 0km');
        
        $maria = new Usuario('Maria');
        $joao = new Usuario('João');
        $ana = new Usuario('Ana');
        $jose = new Usuario('José');
        
        $leilao->recebeLance(new Lance($maria, 2500));
        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($ana, 4000));
        $leilao->recebeLance(new Lance($jose, 5000));
        
        // Act - When
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $maioresLances = $leiloeiro->getMaioresLances();
        
        // Assert - Then
        static::assertCount(3, $maioresLances);
        static::assertEquals(5000, $maioresLances[0]->getValor());
        static::assertEquals(4000, $maioresLances[1]->getValor());
        static::assertEquals(3000, $maioresLances[2]->getValor());
    }

    public function leilaoEmOrdemCrescente(): Leilao
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

        return $leilao;
    }

    public function leilaoEmOrdemDecrescente(): Leilao
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

        return $leilao;
    }

    public function leilaoEmOrdemAleatoria(): Leilao
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

        return $leilao;
    }
}