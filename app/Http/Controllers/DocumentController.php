<?php
namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index(Request $request)
    {
        $year = $request->get('year');
        $category = $request->get('category');

        $query = Document::public();
        if ($year) $query->byYear($year);
        if ($category) $query->byCategory($category);
        $documents = $query->orderByDesc('year')->orderBy('title')->paginate(20);

        $years = Document::public()->distinct()->orderByDesc('year')->pluck('year');
        $categories = ['rapport_annuel' => 'Rapports annuels', 'bilan' => 'Bilans', 'communique' => 'Communiqués', 'presentation' => 'Présentations'];

        return view('pages.documents', compact('documents', 'years', 'categories', 'year', 'category'));
    }

    public function download(int $id)
    {
        $document = Document::findOrFail($id);
        $media = $document->getFirstMedia('file');

        if (!$media) abort(404);

        if ($document->isPublic()) {
            return redirect($media->getUrl());
        }

        // Pour les documents privés : lien signé temporaire
        return Storage::disk('r2')->temporaryUrl(
            $media->getPath(),
            now()->addMinutes(15)
        );
    }
}
