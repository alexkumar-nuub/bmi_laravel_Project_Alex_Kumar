<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
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
        
        .card {
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-header {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .form-control, .form-select {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
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
        
        .height-input-group {
            display: flex;
            gap: 10px;
        }
        
        .height-input {
            flex: 1;
        }
        
        .unit-select {
            width: 100px;
        }
        
        .result-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            margin-bottom: 30px;
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
        
        .bmi-info {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            color: white;
        }
        
        .bmi-scale {
            display: flex;
            margin-top: 20px;
            text-align: center;
            font-size: 0.85rem;
            color: white;
        }
        
        .scale-item {
            flex: 1;
            padding: 10px;
            position: relative;
        }
        
        .scale-item:after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            height: 100%;
            width: 1px;
            background: rgba(255, 255, 255, 0.3);
        }
        
        .scale-item:last-child:after {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">
                        <h2><i class="fas fa-calculator me-2"></i>BMI Calculator</h2>
                    </div>
                    
                    <div class="card-body">
                        <div class="bmi-info">
                            <p class="mb-2">Body Mass Index (BMI) is a measure of body fat based on height and weight. 
                            Use this calculator to check your BMI and understand your weight category.</p>
                            
                            <div class="bmi-scale">
                                <div class="scale-item">
                                    <div>Underweight</div>
                                    <div class="fw-bold">&lt; 18.5</div>
                                </div>
                                <div class="scale-item">
                                    <div>Normal</div>
                                    <div class="fw-bold">18.5 - 24.9</div>
                                </div>
                                <div class="scale-item">
                                    <div>Overweight</div>
                                    <div class="fw-bold">25 - 29.9</div>
                                </div>
                                <div class="scale-item">
                                    <div>Obesity</div>
                                    <div class="fw-bold">≥ 30</div>
                                </div>
                            </div>
                        </div>
                        
                        <form method="POST" action="{{ route('bmi.calculate') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label fw-bold">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required 
                                       placeholder="Enter your name">
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Weight</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" class="form-control" 
                                           name="weight" required placeholder="Enter weight">
                                    <span class="input-group-text">kg</span>
                                </div>
                                <small class="text-white">Enter weight in kilograms</small>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Height</label>
                                <div class="height-input-group">
                                    <div class="height-input">
                                        <input type="number" step="0.1" class="form-control" 
                                               name="height_value" required placeholder="Enter height">
                                    </div>
                                    <div class="unit-select">
                                        <select class="form-select" name="height_unit">
                                            <option value="cm">cm</option>
                                            <option value="ft">feet</option>
                                        </select>
                                    </div>
                                </div>
                                <small class="text-white">Select unit (cm or feet)</small>
                            </div>
                            
                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-calculator me-2"></i>Calculate BMI
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <footer>
                    <p>BMI Calculator &copy; {{ date('Y') }} | Made with Love by Alex </p>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>