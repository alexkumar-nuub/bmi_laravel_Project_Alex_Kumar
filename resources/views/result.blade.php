<!DOCTYPE html>
<html>
<head>
    <title>BMI Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --light: #f8f9fa;
            --dark: #212529;
        }
        
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        
        .result-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            margin-bottom: 30px;
        }
        
        .card-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .bmi-value {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 0;
            background: linear-gradient(to right, var(--primary), var(--success));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .category-badge {
            font-size: 1.2rem;
            padding: 8px 20px;
            border-radius: 50px;
            color: white;
            font-weight: 600;
        }
        
        .category-underweight {
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }
        
        .category-normal {
            background: linear-gradient(to right, #0ba360, #3cba92);
        }
        
        .category-overweight {
            background: linear-gradient(to right, #f6d365, #fda085);
        }
        
        .category-obesity {
            background: linear-gradient(to right, #ff5858, #f09819);
        }
        
        .recent-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .recent-table th {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
        }
        
        footer {
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            margin-top: 30px;
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            border: none;
            border-radius: 10px;
            padding: 12px 20px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(to right, #3a56e4, #2d2bb8);
            transform: translateY(-2px);
        }
        
        .interpretation {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin: 25px 0;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="result-card">
                    <div class="card-header text-center">
                        <h2><i class="fas fa-chart-line me-2"></i>Your BMI Result</h2>
                    </div>
                    
                    <div class="card-body text-center p-4">
                        <h3 class="mb-0">Hello, {{ $records->first()->name }}!</h3>
                        <p class="text-muted">Here's your BMI calculation result</p>
                        
                        <div class="my-4">
                            <h4 class="mb-3">Your BMI is:</h4>
                            <div class="bmi-value">{{ $bmi }}</div>
                            
                            @php
                                $categoryClass = '';
                                if ($category == 'Underweight') $categoryClass = 'category-underweight';
                                elseif ($category == 'Normal weight') $categoryClass = 'category-normal';
                                elseif ($category == 'Overweight') $categoryClass = 'category-overweight';
                                else $categoryClass = 'category-obesity';
                            @endphp
                            
                            <div class="category-badge {{ $categoryClass }} mt-3">
                                {{ $category }}
                            </div>
                        </div>
                        
                        <div class="interpretation text-start">
                            <h4><i class="fas fa-info-circle me-2"></i>What this means:</h4>
                            @if($category == 'Underweight')
                                <p>Your BMI suggests you may be underweight. Consider consulting with a healthcare provider 
                                to ensure you're getting proper nutrition and to rule out any underlying health conditions.</p>
                            @elseif($category == 'Normal weight')
                                <p>Congratulations! Your BMI is in the healthy range. Maintain a balanced diet and regular 
                                physical activity to stay in this healthy range.</p>
                            @elseif($category == 'Overweight')
                                <p>Your BMI suggests you may be overweight. Consider making lifestyle changes such as 
                                improving your diet and increasing physical activity. Consult with a healthcare provider 
                                for personalized advice.</p>
                            @else
                                <p>Your BMI suggests you may be obese. Obesity increases the risk of many health conditions. 
                                We recommend consulting with a healthcare provider to develop a safe weight loss plan.</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="recent-table">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><i class="fas fa-history me-2"></i>Recent Calculations</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Weight (kg)</th>
                                            <th>Height</th>
                                            <th>BMI</th>
                                            <th>Category</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($records as $record)
                                        <tr>
                                            <td>{{ $record->name }}</td>
                                            <td>{{ $record->weight }}</td>
                                            <td>
                                                {{ $record->height_unit === 'ft' ? 
                                                    number_format($record->height / 30.48, 2) . ' ft' : 
                                                    $record->height . ' cm' 
                                                }}
                                            </td>
                                            <td>{{ number_format($record->bmi_value, 1) }}</td>
                                            <td>
                                                @php
                                                    $catClass = '';
                                                    if ($record->category == 'Underweight') $catClass = 'text-primary';
                                                    elseif ($record->category == 'Normal weight') $catClass = 'text-success';
                                                    elseif ($record->category == 'Overweight') $catClass = 'text-warning';
                                                    else $catClass = 'text-danger';
                                                @endphp
                                                <span class="{{ $catClass }}">{{ $record->category }}</span>
                                            </td>
                                            <td>{{ $record->created_at->format('M d') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="d-grid mt-4">
                    <a href="{{ route('bmi.index') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-redo me-2"></i>Calculate Again
                    </a>
                </div>
                
                <footer>
                    <p>BMI Calculator &copy; {{ date('Y') }} | Your health matters</p>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>