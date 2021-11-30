<?php


namespace App\Services;


use App\Http\Requests\ShiftUpdateRequest;
use App\Interfaces\ShiftInterface;
use App\Models\Shift;
use App\Repositories\ShiftRepository;
use Illuminate\Http\Request;

/**
 * Class ShiftService
 * @package App\Services
 */
class ShiftService implements ShiftInterface
{
    /**
     * @var ShiftRepository
     */
    private $shiftRepository;

    /**
     * ShiftService constructor.
     * @param ShiftRepository $shiftRepository
     */
    public function __construct(ShiftRepository $shiftRepository)
    {
        $this->shiftRepository = $shiftRepository;
    }

    /**
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $data)
    {
        return $this->shiftRepository->storeShift($data);
    }

    /**
     * @param Request $request
     * @return false|string
     */
    public function showData(Request $request)
    {
        return $this->shiftRepository->getShiftData($request);
    }

    /**
     * @param Request $request
     * @param Shift $shift
     * @return mixed
     */
    public function update(Request $request, Shift $shift)
    {
        return $this->shiftRepository->updateShift($request, $shift);
    }

    /**
     * @param Shift $shift
     * @return mixed
     */
    public function delete(Shift $shift)
    {
        return $this->shiftRepository->deleteShift($shift);
    }
}
