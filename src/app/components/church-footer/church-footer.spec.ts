import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ChurchFooter } from './church-footer';

describe('ChurchFooter', () => {
  let component: ChurchFooter;
  let fixture: ComponentFixture<ChurchFooter>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [ChurchFooter],
    }).compileComponents();

    fixture = TestBed.createComponent(ChurchFooter);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
