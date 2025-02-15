<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private float $maiorValor = -INF;
    private float $menorValor = INF;

    private $maioresLances;
    
    public function avalia(Leilao $leilao): void
    {
        if($leilao->estaFinalizado()) {
            throw new \DomainException('Leilão já finalizado');
        }
        
        if (empty($leilao->getLances())) {
            throw new \DomainException('Não é possível avaliar um leilão vazio');
        }

        foreach ($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
        }

        $lances = $leilao->getLances();
        usort($lances, function (Lance $lance1, Lance $lance2): float {
            return $lance2->getValor() - $lance1->getValor(); // Ordena do maior valor para o menor
        });
        $this->maioresLances = array_slice($lances, 0, 3);
    }

    /**
     * Getter getMaiorValor
     * @return float
     */
    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    /**
     * Getter getMenorValor
     * @return float
     */
    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    /**
     * Getter getMaioresLances
     * @return array
     */
    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }
}