<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        return view('dashboard');
    }

    public function quiz()
    {
        return view('quiz');
    }

    public function completeQuiz()
    {
        $json = $this->request->getJSON();
        $score = $json->score;
        $level = isset($json->level) ? $json->level : 1;

        if ($level == 1) {
            session()->set('quiz_level1_complete', true);
            session()->set('quiz_level1_score', $score);
        } else if ($level == 2) {
            session()->set('quiz_level2_complete', true);
            session()->set('quiz_level2_score', $score);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function quizLevel2()
    {
        if (!session('quiz_level1_complete')) {
            return redirect()->to('/dashboard');
        }
        return view('quiz_level2');
    }

    public function hiddenQuiz()
    {
        return view('hidden_quiz');
    }

    public function feedback()
    {
        return view('feedback');
    }
}

