<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RuleTableMainCategories;


class RuleTable extends Model
{
    use HasFactory;

    protected $table = 'rule_tables';

    protected $fillable = [
        'rule_name',
        'rule_description',
        'rule_type',
        'rule_threat_level',
        'rule_source',
        'rule_destination',
        'rule_conditions',
        'rule_related',
        'rule_status',
        'rule_category',
        'rule_tags',
        'rule_applicability',
        'rule_risk_score',
        'rule_test_status',
        'rule_test_date',
        'rule_tested_by',
        'rule_alert_level',
        'rule_documentation',
        'rule_related_policies',
        'rule_audit_log',
        'rule_incident_logs',
        'rule_requirements',
        'rule_priority',
        'rule_related_assets',
        'rule_created_by',
        'rule_updated_by',
    ];

    public $timestamps = false;

    protected $dates = [
        'rule_creation_date',
        'rule_last_update',
        'rule_test_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'rule_created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'rule_updated_by');
    }

    public function getRuleNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function setRuleNameAttribute($value)
    {
        $this->attributes['rule_name'] = strtolower($value);
    }

public function mainCategory()
{
    return $this->belongsTo(RuleTableMainCategories::class, 'main_category_id');
}

public function ruleTableSb()
{
    return $this->belongsTo(RuleTableSb::class, 'table_id', 'id');
}


}
