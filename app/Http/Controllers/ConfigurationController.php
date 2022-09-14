<?php

namespace App\Http\Controllers;

use App\Configuration;
use App\Http\Requests\UpdateConfigurationRequest;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $configs = Configuration::paginate(20);
        return view('admin.configuration.index',compact('configs'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return RedirectResponse | View
     */
    public function edit($id)
    {
        $config = Configuration::find($id);

        if(!$config) {
            return redirect()->route('configuration.index')->with('error', 'Student not found.');
        }

        $config->value = $config->data_type == 'datetime' ?
            Carbon::createFromFormat('Y-m-d H:i:s', $config->value)->format('m-d-Y H:i') :
            $config->value;

        return view('admin.configuration.edit', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateConfigurationRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateConfigurationRequest $request, $id): RedirectResponse
    {
        $validated = $request->validated();
        $configuration = Configuration::find($id);

        if(!$configuration) {
            return redirect()->route('configuration.index')->with('error', 'Configuration not found.');
        }

        if($configuration->data_type == 'datetime') {
            try {
                $configuration->value = Carbon::createFromFormat('m-d-Y H:i', $validated['value']);
            } catch (\Exception $e) {
                return redirect()->route('configuration.index')->with('error', 'Could not update key ' . $validated['key'] . '. Incorrect format.');
            }
        } else {
            $configuration->value = $validated['value'];
        }
        $configuration->save();

        return redirect()->route('configuration.index')->with('success', 'Configuration updated successfully.');
    }
}
