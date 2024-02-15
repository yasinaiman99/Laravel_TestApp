<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardDistributionController extends Controller
{
    public function distribute(Request $request)
    {
        $numPeople = $request->input('num_people');

        if (!is_numeric($numPeople) || $numPeople < 1) {
            return "Input value does not exist or value is invalid";
        }

        if ($numPeople > 53) {
            $numPeople = 53;
        }

        $deck = $this->createDeck();
        $distributedCards = $this->distributeCards($deck, $numPeople);

        $output = '';
        foreach ($distributedCards as $person_cards) {
            $output .= implode(',', $person_cards) . "\n";
        }

        return $output;
    }

    private function createDeck()
    {
        $suits = array('S', 'H', 'D', 'C');
        $faces = array('A', 2, 3, 4, 5, 6, 7, 8, 9, 'X', 'J', 'Q', 'K');
        $deck = array();

        foreach ($suits as $suit) {
            foreach ($faces as $face) {
                $deck[] = $suit . '-' . $face;
            }
        }

        return $deck;
    }

    private function distributeCards($deck, $num_people)
    {
        $result = array();

        for ($i = 0; $i < $num_people; $i++) {
            $result[$i] = array();
        }

        $index = 0;
        while (!empty($deck)) {
            $card = array_pop($deck);
            $result[$index][] = $card;
            $index = ($index + 1) % $num_people;
        }

        return $result;
    }
}
