<?
namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class Activity
{
    public static function log(string $action, string $module, string $description)
    {
        ActivityLog::create([
            'user_id' => Auth::user()?->id,
            'action' => $action,
            'module' => $module,
            'description' => $description,
        ]);
    }
}
