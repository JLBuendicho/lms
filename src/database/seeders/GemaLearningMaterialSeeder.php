<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GemaLearningMaterialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('learning_materials')->insert([
            [
                'grade_lvl_id' => 1,
                'subject_id' => 1,
                'domain_id' => 1,
                'topic_id' => 1,
                'skill_id' => 1,
                'title' => 'GEMA - Order of Operations',
                'material_type' => 'resource',
                'content' => '"<h1>GEMA: A Cleaner Way to Remember Order of Operations</h1><p><strong>GEMA</strong> stands for:</p><table><tbody><tr><th rowspan=\\"1\\" colspan=\\"1\\"><p>Letter</p></th><th rowspan=\\"1\\" colspan=\\"1\\"><p>Stands for</p></th><th rowspan=\\"1\\" colspan=\\"1\\"><p>Covers</p></th></tr><tr><td rowspan=\\"1\\" colspan=\\"1\\"><p><strong>G</strong></p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Grouping</p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Parentheses ( ), brackets [ ], braces { }</p></td></tr><tr><td rowspan=\\"1\\" colspan=\\"1\\"><p><strong>E</strong></p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Exponents</p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Powers and roots</p></td></tr><tr><td rowspan=\\"1\\" colspan=\\"1\\"><p><strong>M</strong></p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Multiplication/Division</p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Done together, left to right</p></td></tr><tr><td rowspan=\\"1\\" colspan=\\"1\\"><p><strong>A</strong></p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Addition/Subtraction</p></td><td rowspan=\\"1\\" colspan=\\"1\\"><p>Done together, left to right</p></td></tr></tbody></table><h2>Why GEMA over GEMDAS?</h2><p>GEMDAS (or PEMDAS) writes multiplication and division as separate letters, and addition and subtraction as separate letters — which tricks a lot of students into thinking multiplication always comes before division, or addition always comes before subtraction. That&#039;s <strong>not true</strong>. They&#039;re actually tied pairs:</p><ul><li><p>Multiplication and Division have <strong>equal priority</strong> — whichever comes first (left to right) gets done first.</p></li><li><p>Addition and Subtraction have <strong>equal priority</strong> — same rule.</p></li></ul><p>GEMA makes that grouping explicit instead of hiding it in four separate letters. One &quot;M&quot; block, one &quot;A&quot; block. Less to memorize, less room for the &quot;always multiply before you divide&quot; mistake.</p><h2>The Rule in Plain Terms</h2><ol start=\\"1\\"><li><p><strong>G</strong> — Solve everything inside grouping symbols first (innermost first if nested).</p></li><li><p><strong>E</strong> — Simplify exponents and roots.</p></li><li><p><strong>M</strong> — Do all multiplication and division, scanning left to right.</p></li><li><p><strong>A</strong> — Do all addition and subtraction, scanning left to right.</p></li></ol><hr><h2>Example 1: Basic GEMA</h2><p><strong>Problem:</strong><br>6 + 2 x (5 - 3)<sup>2</sup> / 4</p><p><strong>Step 1 — G (Grouping):</strong><br>5 - 3 = 2<br>6 + 2 x 2<sup>2</sup> / 4</p><p><strong>Step 2 — E (Exponents):</strong><br>2<sup>2</sup> = 4<br>6 + 2 x 4 / 4</p><p><strong>Step 3 — M (Multiplication/Division, left to right):</strong><br>2 x 4 = 8 -&gt; 8 / 4 = 2<br>6 + 2</p><p><strong>Step 4 — A (Addition/Subtraction):</strong><br>6 + 2 = 8</p><p><strong>Answer: 8</strong></p><hr><h2>Example 2: Why &quot;left to right&quot; matters for M</h2><p><strong>Problem:</strong><br>20 / 4 x 5</p><p>A student who thinks &quot;multiplication always beats division&quot; might do 4×5 first — <strong>wrong</strong>. GEMA says: scan left to right within the M step.</p><p>20 / 4 = 5<br>5 x 5 = 25</p><p><strong>Answer: 25</strong> (not 1, which is what you&#039;d get doing it the wrong order)</p><hr><h2>Example 3: Nested grouping symbols</h2><p><strong>Problem:</strong><br>3 x [ (8 - 2) + 4<sup>2</sup> ] - 10</p><p><strong>Step 1 — G (innermost first):</strong><br>8 - 2 = 6<br>3 x [6 + 4<sup>2</sup>] - 10</p><p><strong>Step 2 — E (still inside the bracket):</strong><br>4<sup>2</sup> = 16<br>3 x [6 + 16] - 10</p><p><strong>Step 3 — Finish G:</strong><br>6 + 16 = 22<br>3 x 22 - 10</p><p><strong>Step 4 — M:</strong><br>3 x 22 = 66<br>66 - 10</p><p><strong>Step 5 — A:</strong><br>66 - 10 = 56</p><p><strong>Answer: 56</strong></p><hr><h2>Quick Practice (try these yourself)</h2><ol start=\\"1\\"><li><p>4 + 3 x (6 - 2)<sup>2</sup></p></li><li><p>18 / 2 x 3 - 5</p></li><li><p>(7 + 3) x 2<sup>3</sup> / 4 - 1</p></li></ol><p> Answers</p><ol start=\\"1\\"><li><p>52</p></li><li><p>22</p></li><li><p>39</p></li></ol><hr><p><strong>Key takeaway:</strong> GEMA isn&#039;t a different rule from PEMDAS/GEMDAS — it&#039;s the <em>same</em> order of operations, just written honestly: 4 priority levels, not 6, because M‑pairs and A‑pairs are always tied and resolved left to right.</p>"',
                'content_front' => null,
                'content_back' => null,
                'content_audio_visual_path' => 'learning_materials/1/audio_visual/01M2NFRKB1WHSPX76X34AHT5GG.mp4',
                'attachments' => json_encode([]),
                'attachment_file_names' => json_encode([]),
                'created_at' => '2026-09-16 15:27:48',
                'updated_at' => '2026-09-16 16:10:56'
            ]
        ]);
    }
}