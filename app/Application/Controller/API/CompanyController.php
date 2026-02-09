<?php

namespace App\Application\Controller\API;

use App\Core\Company\Company;
use App\Core\Company\CompanyService;
use Illuminate\Http\Request;

class CompanyController extends APIController
{
    public function __construct(
        protected CompanyService $service
    ) {}

    public function getAll()
    {
        $companies = $this->service->getAll();

        return array_map(function (Company $company) {
            return $company->toObject();
        }, $companies);
    }

    public function getById(Request $request, string $id)
    {
        $company = $this->service->getById($id);

        return $company->toObject();
    }

    public function create(Request $request)
    {
        $entity = new Company([
            'name' => $request->input('name'),
            'country' => $request->input('country'),
            'description' => $request->input('description') ?? ''
        ]);

        $created = $this->service->create($entity);

        return $created->toObject();
    }

    public function update(Request $request, string $id)
    {
        $entity = new Company([
            'id' => $id,
            'name' => $request->input('name'),
            'country' => $request->input('country'),
            'description' => $request->input('description') ?? ''
        ]);

        $updated = $this->service->update($id, $entity);

        return $updated->toObject();
    }

    public function delete(Request $request, string $id)
    {
        $deleted = $this->service->delete($id);

        return [
            'success' => $deleted
        ];
    }
}
