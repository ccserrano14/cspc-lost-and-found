<?php namespace App\Controllers;

use App\Models\ItemModel;

class ItemController extends BaseController
{
    protected $itemModel;
    protected $uploadPath;

    public function __construct()
    {
        helper(['form', 'url', 'session']);
        $this->itemModel = new ItemModel();
        $this->uploadPath = FCPATH . 'uploads/';
    }

    public function index()
    {
        $status = $this->request->getGet('status');
        if ($status && in_array($status, ['pending', 'claimed'])) {
            $items = $this->itemModel->where('status', $status)->orderBy('created_at', 'desc')->findAll();
        } else {
            $items = $this->itemModel->orderBy('created_at', 'desc')->findAll();
        }
        return view('items/index', ['items' => $items]);
    }

    public function create()
    {
        return view('items/create');
    }

    public function store()
    {
        $validationRules = [
            'name' => 'required|min_length[3]',
            'description' => 'required|min_length[5]',
            'status' => 'required|in_list[pending,claimed]',
            'condition' => 'required|in_list[lost,found]',
            'image' => 'uploaded[image]|is_image[image]|max_size[image,2048]'
        ];

        if (!$this->validate($validationRules)) {
            return view('items/create', ['validation' => $this->validator]);
        }

        $imageFile = $this->request->getFile('image');
        $imageName = null;
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move($this->uploadPath, $imageName);
        }

        $this->itemModel->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'condition' => $this->request->getPost('condition'),
            'image' => $imageName,
        ]);

        session()->setFlashdata('success', 'Item created successfully.');
        return redirect()->to('/items');
    }

    public function edit($id = null)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Item not found');
        }
        return view('items/edit', ['item' => $item]);
    }

    public function update($id = null)
    {
        $validationRules = [
            'name' => 'required|min_length[3]',
            'description' => 'required|min_length[5]',
            'status' => 'required|in_list[pending,claimed]',
            'condition' => 'required|in_list[lost,found]',
            'image' => 'is_image[image]|max_size[image,2048]'
        ];

        if (!$this->validate($validationRules)) {
            $item = $this->itemModel->find($id);
            return view('items/edit', ['validation' => $this->validator, 'item' => $item]);
        }

        $item = $this->itemModel->find($id);
        $imageFile = $this->request->getFile('image');
        $imageName = $item['image']; // keep old image by default

        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            // Delete old image file if exists
            if ($imageName && file_exists($this->uploadPath . $imageName)) {
                unlink($this->uploadPath . $imageName);
            }
            $imageName = $imageFile->getRandomName();
            $imageFile->move($this->uploadPath, $imageName);
        }

        $this->itemModel->update($id, [
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'status' => $this->request->getPost('status'),
            'condition' => $this->request->getPost('condition'),
            'image' => $imageName,
        ]);

        session()->setFlashdata('success', 'Item updated successfully.');
        return redirect()->to('/items');
    }

    public function delete($id = null)
    {
        $item = $this->itemModel->find($id);
        if ($item) {
            if ($item['image'] && file_exists($this->uploadPath . $item['image'])) {
                unlink($this->uploadPath . $item['image']);
            }
            $this->itemModel->delete($id);
            session()->setFlashdata('success', 'Item deleted successfully.');
        }
        return redirect()->to('/items');
    }

    public function show($id = null)
    {
        $item = $this->itemModel->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Item not found');
        }
        return view('items/show', ['item' => $item]);
    }
}
