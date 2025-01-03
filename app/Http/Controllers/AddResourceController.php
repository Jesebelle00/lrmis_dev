<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AddResourceController extends Controller
{

    public function source()
    {
        $sources = DB::table('source')
        ->select('id', 'name')
        ->get();

        return response()->json($sources);
    }

    public function status()
    {
        $status = DB::table('status')
        ->select('id', 'name')
        ->get();

        return response()->json($status);
    }

    public function getSubjectGradeLevels()
    {
        // Execute the raw SQL query
        $subjects = DB::select(
            'SELECT
                s.id AS SubjectID,
                s.title AS SubjectTitle,
                s.shortcode AS SubjectShortCode,
                MAX(CASE WHEN g.id = 1 THEN sg.id ELSE NULL END) AS "1",
                MAX(CASE WHEN g.id = 2 THEN sg.id ELSE NULL END) AS "2",
                MAX(CASE WHEN g.id = 3 THEN sg.id ELSE NULL END) AS "3",
                MAX(CASE WHEN g.id = 4 THEN sg.id ELSE NULL END) AS "4",
                MAX(CASE WHEN g.id = 5 THEN sg.id ELSE NULL END) AS "5",
                MAX(CASE WHEN g.id = 6 THEN sg.id ELSE NULL END) AS "6",
                MAX(CASE WHEN g.id = 7 THEN sg.id ELSE NULL END) AS "7",
                MAX(CASE WHEN g.id = 8 THEN sg.id ELSE NULL END) AS "8",
                MAX(CASE WHEN g.id = 9 THEN sg.id ELSE NULL END) AS "9",
                MAX(CASE WHEN g.id = 10 THEN sg.id ELSE NULL END) AS "10",
                MAX(CASE WHEN g.id = 11 THEN sg.id ELSE NULL END) AS "11",
                MAX(CASE WHEN g.id = 12 THEN sg.id ELSE NULL END) AS "12",
                MAX(CASE WHEN g.id = 13 THEN sg.id ELSE NULL END) AS "13"
            FROM
                subject AS s
            LEFT JOIN
                subject_grade_level AS sg ON s.id = sg.subject_id
            LEFT JOIN
                grade_level AS g ON sg.gradelevel_id = g.id
            GROUP BY
                s.id, s.title, s.shortcode
            ORDER BY
                s.title'
        );

        // Transform the result into the desired format
        $formattedSubjects = array_map(function ($subject) {
            return [
                'SubjectID' => $subject->SubjectID,
                'SubjectTitle' => $subject->SubjectTitle,
                'SubjectShortCode' => $subject->SubjectShortCode,
                'GradeLevels' => array_filter([
                    '1' => $subject->{'1'},
                    '2' => $subject->{'2'},
                    '3' => $subject->{'3'},
                    '4' => $subject->{'4'},
                    '5' => $subject->{'5'},
                    '6' => $subject->{'6'},
                    '7' => $subject->{'7'},
                    '8' => $subject->{'8'},
                    '9' => $subject->{'9'},
                    '10' => $subject->{'10'},
                    '11' => $subject->{'11'},
                    '12' => $subject->{'12'},
                    '13' => $subject->{'13'},
                ], function ($value) {
                    return $value !== null; // Remove null values
                }),
            ];
        }, $subjects);
        return response()->json(['subjects' => $formattedSubjects]);
    }


    public function getSubjects()
    {
        // Execute the raw SQL query
        $subjects = Subject::all();

        // Return the result as a JSON response
        return response()->json(['subjects' => $subjects]);
    }

    public function subjectgradeLevel()
    {
        $subjects = DB::table('subject_grade_level as sg')
            ->join('subject as s', 'sg.subject_id', '=', 's.id')
            ->join('grade_level as g', 'sg.gradelevel_id', '=', 'g.id')
            ->select(
                'sg.id as subjectgradelevel_id',
                's.title as subject_title',
                'g.shortcode as gradelevel_shortcode'
            )
            ->orderBy('g.id', 'asc')
            ->get();

        return response()->json(['subjects' => $subjects]);
    }

    public function searchTitle(Request $request)
    {
        $term = trim($request->input('term', ''));

        $results = DB::table('lr')
            ->join('title as ti', 'lr.title_id', '=', 'ti.id')
            ->select('lr.id', 'lr.type_id', 'lr.title_id', 'ti.id as title_id', 'ti.name')
            ->where('lr.type_id', 1)
            ->where('ti.name', 'LIKE', "%{$term}%")
            ->limit(10)
            ->get();

        if ($results->isEmpty()) {
            return response()->json([
                'html' => '<p>No results found. Add the title first.</p>',
            ]);
        }

        $html = '';
        foreach ($results as $row) {
            $html .= '<div class="suggestion-item" data-id="' . $row->title_id . '">' . $row->name . '</div>';
        }

        return response()->json(['html' => $html]);
    }

    public function searchAuthor(Request $request)
    {
        $term = trim($request->input('term', ''));

        $authors = DB::table('author')
                        ->where('name', 'LIKE', "%{$term}%")
                        ->limit(10)
                        ->get();

        if ($authors->isEmpty()) {
            return response()->json([
                'html' => '<p>No Authors found. Add the author first.</p>',
            ]);
        }

        $html = '';
        foreach ($authors as $row) {

            $html .= '<div class="auth-suggestion-item" data-id="' . $row->id . '">' . $row->name . '</div>';
        }

        return response()->json(['html' => $html]);
    }

    public function searchPublisher(Request $request)
    {
        $term = trim($request->input('term', ''));

        $publishers = DB::table('publisher')
                        ->where('name', 'LIKE', "%{$term}%")
                        ->limit(10)
                        ->get();

        if ($publishers->isEmpty()) {
            return response()->json([
                'html' => '<p>No Publisher found. Add the publisher first.</p>',
            ]);
        }

        $html = '';
        foreach ($publishers as $row) {

            $html .= '<div class="pub-suggestion-item" data-id="' . $row->id . '">' . $row->name . '</div>';
        }

        return response()->json(['html' => $html]);
    }

    public function searchbrand(Request $request)
    {
        $term = trim($request->input('term', ''));

        $brands = DB::table('brand')
                        ->where('name', 'LIKE', "%{$term}%")
                        ->limit(10)
                        ->get();

        if ($brands->isEmpty()) {
            return response()->json([
                'html' => '<p>No Brand found. Add the Brand first.</p>',
            ]);
        }

        $html = '';
        foreach ($brands as $row) {

            $html .= '<div class="brand-suggestion-item" data-id="' . $row->id . '">' . $row->name . '</div>';
        }

        return response()->json(['html' => $html]);
    }

    public function getPrintTypes()
    {
        $printTypes = DB::table('type_name')
            ->where('cat_id', 1)
            ->select('id', 'type_name')
            ->get();
        return response()->json($printTypes);
    }
    public function getNonPrintTypes()
    {
        $nonPrintTypes = DB::table('type_name')
            ->where('cat_id', 2)
            ->select('id', 'type_name')
            ->get();
        return response()->json($nonPrintTypes);
    }

    public function addPrintResource(Request $request)
    {
        // $validated = $request->validate([
        //     'search' => 'required|string|max:255',
        //     'selectedID' => 'nullable|integer',
        //     'print_type' => 'required|string|max:50',
        //     'subjects' => 'required|string|max:255',
        //     'print_author' => 'required|string|max:255',
        //     'selectedAuthors' => 'nullable|string|max:255',
        //     'pubSelectedID' => 'nullable|string|max:255',
        //     'publisherPrint' => 'nullable|string|max:255',
        //     'volume' => 'nullable|string|max:50',
        //     'copyright' => 'nullable|integer|between:1900,3000',
        //     'pages' => 'required|integer|min:1',
        //     'print_source' => 'required|string|max:50',
        //     'print_status' => 'required|string|max:50',
        //     'qty' => 'required|integer|min:1',
        //     'acqrd' => 'required|date',
        //     'remarks' => 'nullable|string|max:1000',
        // ]);

        // return response()->json(['success' => true, 'data' => $validated]);

        //Normal Scenario

        DB::beginTransaction();

        try {
            // Step 1: Insert into `lr` table
            $lrId = Str::uuid()->toString();
            $lrInserted = DB::table('lr')->insert([
                'id' => $lrId,
                'type_id' => $request->print_type,
                'title_id' => $request->selectedID,
            ]);

            if (!$lrInserted) {
                throw new \Exception('Failed to insert into lr table.');
            }

            // Step 2: Insert into `lr_print` table
            $lrPrintId = Str::uuid()->toString();
            $lrPrintInserted = DB::table('lr_print')->insert([
                'id' => $lrPrintId,
                'lr_id' => $lrId,
                'publisher_id' => $request->pubSelectedID,
                'volume' => $request->volume,
                'copyright' => $request->copyright,
                'pages' => $request->pages,
            ]);

            if (!$lrPrintInserted) {
                throw new \Exception('Failed to insert into lr_print table.');
            }

            // Step 3: Insert into `acquisition` table
            $acquisitionId = Str::uuid()->toString();
            $acquisitionInserted = DB::table('acquisition')->insert([
                'id' => $acquisitionId,
                'lr_id' => $lrId,
                'src_id' => $request->print_source,
                'date_acquired' => $request->acqrd,
                'qty' => $request->qty,
                'status_id' => $request->print_status,
                'remarks' => $request->remarks,
            ]);

            if (!$acquisitionInserted) {
                throw new \Exception('Failed to insert into acquisition table.');
            }

            // Step 4: Insert into `lr_subject_grade_level` table
            $subjectGradeLevelIds = explode(',', $request->subjects);
            foreach ($subjectGradeLevelIds as $subjectGradeLevelId) {
                $lrSubjectGradeLevelInserted = DB::table('lr_subject_grade_level')->insert([
                    'id' => Str::uuid()->toString(),
                    'lr_id' => $lrId,
                    'subjectgradelevel_id' => $subjectGradeLevelId,
                ]);

                if (!$lrSubjectGradeLevelInserted) {
                    throw new \Exception('Failed to insert into lr_subject_grade_level table.');
                }
            }

            // Step 5: Insert into `masterlist` table (only if all above are successful)
            for ($i = 0; $i < $request->quantity; $i++) {
                $masterlistInserted = DB::table('masterlist')->insert([
                    'id' => Str::uuid()->toString(),
                    'acquisition_id' => $acquisitionId,
                    'status_id' => $request->print_status,
                ]);

                if (!$masterlistInserted) {
                    throw new \Exception('Failed to insert into masterlist table.');
                }
            }

            DB::commit();
            return response()->json(['message' => 'Data saved successfully'], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error saving data', 'error' => $e->getMessage()], 500);
        }

        // return response()->json([
        //     'success' => true,
        //     'data' => $request->all(),
        // ]);

    }

}
