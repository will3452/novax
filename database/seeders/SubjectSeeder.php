<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                "name" => "Introduction to Psychology",
                "code" => "PSYCH 101",
                "description" => "An introduction to the scientific study of human behavior and mental processes. Topics include the history of psychology, research methods, biological bases of behavior, sensation and perception, learning and memory, cognition, motivation and emotion, developmental psychology, social psychology, and abnormal psychology.",
                "has_lab" => false,
            ],
            [
                "name" => "Principles of Microeconomics",
                "code" => "ECON 101",
                "description" => "An introduction to the principles of microeconomics, including supply and demand, consumer and producer behavior, market structure and competition, efficiency and welfare, externalities and public goods, and international trade.",
                "has_lab" => false,
            ],
            [
                "name" => "General Chemistry",
                "code" => "CHEM 101",
                "description" => "An introduction to the fundamental principles of chemistry, including atomic and molecular structure, chemical bonding, stoichiometry, gases, liquids and solids, thermodynamics, equilibrium, acids and bases, and electrochemistry.",
                "has_lab" => true,
            ],
            [
                "name" => "Calculus I",
                "code" => "MATH 101",
                "description" => "An introduction to differential and integral calculus of one variable, including limits, continuity, derivatives, applications of derivatives, definite and indefinite integrals, and applications of integrals.",
                "has_lab" => false,
            ],
            [
                "name" => "Introduction to Computer Science",
                "code" => "CS 101",
                "description" => "An introduction to computer programming and problem solving, including fundamental concepts of programming, control structures, data structures, algorithms, recursion, and object-oriented programming.",
                "has_lab" => true,
            ],
            [
                "name" => "World History I",
                "code" => "HIST 101",
                "description" => "A survey of world history from prehistoric times to the early modern era, including the development of early civilizations, the classical Mediterranean world, the spread of Islam, medieval Europe, and the Renaissance.",
                "has_lab" => false,
            ],
            [
                "name" => "Statistics",
                "code" => "STAT 101",
                "description" => "An introduction to the principles of statistical analysis, including descriptive statistics, probability, hypothesis testing, regression analysis, and statistical inference.",
                "has_lab" => true,
            ],
            [
                "name" => "Organic Chemistry",
                "code" => "CHEM 201",
                "description" => "An in-depth study of the structure, properties, and reactions of organic compounds, including the functional groups, stereochemistry, and mechanisms of reactions.",
                "has_lab" => true,
            ],
            [
                "name" => "Macroeconomics",
                "code" => "ECON 201",
                "description" => "An introduction to the principles of macroeconomics, including national income accounting, economic growth, inflation, unemployment, monetary policy, fiscal policy, and international finance.",
                "has_lab" => false,
            ],
            [
                "name" => "Linear Algebra",
                "code" => "MATH 201",
                "description" => "An introduction to the theory and applications of linear algebra, including matrices, determinants, vector spaces, linear transformations, eigenvalues, and eigenvectors.",
                "has_lab" => false,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
