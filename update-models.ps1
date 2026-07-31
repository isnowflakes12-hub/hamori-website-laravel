$models = @("LayananUnggulan.php", "Banner.php", "Promo.php", "Dokter.php", "Artikel.php")
foreach ($model in $models) {
    $path = "app\Models\$model"
    $content = Get-Content $path -Raw
    
    if ($content -notmatch "use Spatie\\Activitylog\\Traits\\LogsActivity;") {
        $content = $content -replace "use Illuminate\\Database\\Eloquent\\Model;", "use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;"
    }
    
    if ($content -notmatch "use LogsActivity;") {
        $content = $content -replace "(class \w+ extends Model\s*\{\s*)", "$1use LogsActivity;

    "
    }

    if ($content -notmatch "getActivitylogOptions") {
        $method = "
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs();
    }
}"
        $content = $content -replace "\}$", $method
    }
    
    Set-Content -Path $path -Value $content
}
