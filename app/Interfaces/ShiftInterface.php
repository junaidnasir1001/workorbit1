<?php


namespace App\Interfaces;


use App\Models\Shift;
use Illuminate\Http\Request;

/**
 * Interface ShiftInterface
 * @package App\Interfaces
 */
interface ShiftInterface
{
    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);

    /**
     * @param Request $request
     * @return mixed
     */
    public function showData(Request $request);

    /**
     * @param Request $request
     * @param Shift $shift
     * @return mixed
     */
    public function update(Request $request, Shift $shift);

    /**
     * @param Shift $shift
     * @return mixed
     */
    public function delete(Shift $shift);
}
