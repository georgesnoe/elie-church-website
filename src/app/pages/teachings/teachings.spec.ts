import { ComponentFixture, TestBed } from '@angular/core/testing';

import { Teachings } from './teachings';

describe('Teachings', () => {
  let component: Teachings;
  let fixture: ComponentFixture<Teachings>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [Teachings],
    }).compileComponents();

    fixture = TestBed.createComponent(Teachings);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
